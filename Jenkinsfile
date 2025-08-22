pipeline {
    agent any

    environment {
        APP_NAME = 'tokoman' 
    }
    
    stages {
        stage('Checkout Code') {
            steps {
                echo "Mengambil kode untuk aplikasi: ${env.APP_NAME}"
                checkout scm
            }
        }

        stage('Create .env from Credentials') {
            steps {
                withCredentials([file(credentialsId: "${env.APP_NAME}-env-prod", variable: 'DOTENV_FILE')]) {
                    sh "cp \$DOTENV_FILE .env"
                }
            }
        }

        stage('Blue-Green Deploy') {
            steps {
                script {
                    def composeFile = 'docker-compose-app.yml'
                    
                    def runningContainers = sh(script: "docker ps --format '{{.Names}}' | grep '${env.APP_NAME}_blue_web_1' || true", returnStdout: true).trim()
                    
                    def currentColor = 'green'
                    if (runningContainers) {
                        currentColor = 'blue'
                    }
                    def nextColor = (currentColor == 'blue') ? 'green' : 'blue'

                    echo "--- Versi aktif: ${currentColor}. Deploy versi baru: ${nextColor}"

                    try {
                        sh "docker compose -p ${env.APP_NAME}_${nextColor} up -d --build"

                        sh """
                        # Salin variabel Groovy ke variabel Shell agar tidak 'null'
                        APP_NAME="${env.APP_NAME}"
                        NEXT_COLOR="${nextColor}"

                        set +e
                        HEALTHY=false
                        echo "--- Memulai Health Check untuk \${NEXT_COLOR}..."

                        for i in {1..24}; do
                            # Tanya ID kontainer 'web' langsung ke docker compose
                            WEB_CONTAINER_ID=\$(docker compose -p \${APP_NAME}_\${NEXT_COLOR} ps -q web)

                            if [ -z "\$WEB_CONTAINER_ID" ]; then
                                echo "Kontainer web \${NEXT_COLOR} belum siap. Menunggu..."
                                sleep 5
                                continue
                            fi

                            # Jalankan curl dari dalam kontainer web ke dirinya sendiri
                            STATUS=\$(docker exec \$WEB_CONTAINER_ID curl -s -o /dev/null -w '%{http_code}' http://localhost/health)
                            
                            if [ "\$STATUS" -eq 200 ]; then
                                echo "--- Kontainer \${NEXT_COLOR} sehat! (Status: \$STATUS)"
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
                            exit 1
                        fi
                        """

                        def oldContainers = sh(script: "docker ps -qf 'name=${env.APP_NAME}_${currentColor}'", returnStdout: true).trim()
                        if (oldContainers) {
                            echo "--- Mematikan versi lama: ${currentColor}"
                            sh "docker compose -p ${env.APP_NAME}_${currentColor} down -v"
                        }
                        echo "--- Deployment berhasil! Versi ${nextColor} sekarang aktif."

                    } catch (e) {
                        echo "--- Terjadi kesalahan, membersihkan deployment ${nextColor}..."
                        sh "docker compose -p ${env.APP_NAME}_${nextColor} down -v --remove-orphans"
                        currentBuild.result = 'FAILURE'
                        error("Deployment gagal: ${e.message}")
                    }
                }
            }
        }
        
        stage('Clean Up Old Images') {
            steps {
                echo '--- Membersihkan image Docker yang tidak terpakai ---'
                sh 'docker image prune -f'
            }
        }
    }

    post {
        always {
            cleanWs(deleteDirs: true, notFailBuild: true)
        }
    }
}
