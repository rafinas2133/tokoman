pipeline {
    agent any
    
    stages {
        stage('Checkout Code from GitHub') {
            steps {
                echo 'Mengambil kode terbaru...'
                checkout scm
            }
        }

        stage('Create .env from Credentials') {
            steps {
                withCredentials([file(credentialsId: 'tokoman-env-prod', variable: 'DOTENV_FILE')]) {
                    sh "cp \$DOTENV_FILE .env"
                }
            }
        }

        stage('Blue-Green Deploy') {
            steps {
                script {
                    def runningContainers = sh(script: "docker ps --format '{{.Names}}' | grep 'tokoman_blue_web-tokoman' || true", returnStdout: true).trim()
                    
                    def currentColor = 'green'
                    if (runningContainers) {
                        currentColor = 'blue'
                    }
                    def nextColor = (currentColor == 'blue') ? 'green' : 'blue'

                    echo "--- Versi aktif saat ini: ${currentColor}"
                    echo "--- Melakukan deployment versi baru: ${nextColor}"

                    try {
                        echo "--- Membangun dan menjalankan kontainer ${nextColor}..."
                        sh "docker compose -p tokoman_${nextColor} up -d --build"

                        echo "--- Menunggu kontainer ${nextColor} siap..."

                        sh """
                        set +e # Jangan hentikan pipeline jika curl gagal sementara
                        HEALTHY=false
                        for i in {1..24}; do
                          # Dapatkan IP kontainer web yang baru
                          NEW_WEB_CONTAINER_ID=\$(docker ps -qf "name=tokoman_${nextColor}_web-tokoman")
                          if [ -z "\$NEW_WEB_CONTAINER_ID" ]; then
                              echo "Kontainer web ${nextColor} tidak ditemukan. Menunggu..."
                              sleep 5
                              continue
                          fi

                          # Cek status kesehatan
                          STATUS=\$(docker exec \$NEW_WEB_CONTAINER_ID curl -s -o /dev/null -w '%{http_code}' http://localhost/health)
                          if [ "\$STATUS" -eq 200 ]; then
                            echo "--- Kontainer ${nextColor} sehat! (Status: \$STATUS)"
                            HEALTHY=true
                            break
                          else
                            echo "--- Menunggu... percobaan \$i, status: \$STATUS"
                            sleep 5
                          fi
                        done
                        set -e
                        
                        if [ "\$HEALTHY" != "true" ]; then
                          echo "--- Kontainer baru GAGAL health check. Melakukan rollback."
                          exit 1 # Ini akan memicu blok failure
                        fi
                        """

                        def oldContainers = sh(script: "docker ps -qf 'name=tokoman_${currentColor}'", returnStdout: true).trim()
                        if (oldContainers) {
                            echo "--- Mematikan versi lama: ${currentColor}"
                            sh "docker compose -p tokoman_${currentColor} down -v"
                        }

                        echo "--- Deployment berhasil! Versi ${nextColor} sekarang aktif."

                    } catch (e) {
                        echo "--- Terjadi kesalahan, membersihkan deployment ${nextColor}..."
                        sh "docker compose -p tokoman_${nextColor} down -v --remove-orphans"
                        currentBuild.result = 'FAILURE'
                        error("Deployment gagal: ${e.message}")
                    }
                }
            }
        }
        
        stage('Clean Up Old Images') {
            steps {
                echo '--- MEMBERSIHKAN IMAGE DOCKER LAMA ---'
                sh 'docker image prune -f'
            }
        }
    }

    post {
        always {
            cleanWs(deleteDirs: true, notFailBuild: true)
        }
        success {
            echo 'Pipeline berhasil!'
        }
        failure {
            echo 'Pipeline GAGAL!'
        }
    }
}
