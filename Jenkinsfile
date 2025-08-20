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

        stage('Build vite assets (debug)') {
            steps {
                echo '--- CEK HASIL BUILD VITE ---'
                sh '''
                # Build image sampai stage vite_build
                docker compose build --no-cache app-tokoman

                # cari image intermediate vite_build
                VITE_IMG=$(docker images | grep tokoman_vite_build | awk '{print $3}' | head -n1)

                echo "Image vite_build ID: $VITE_IMG"

                # bikin container sekali pakai
                docker create --name tmp_vite_build $VITE_IMG

                # copy hasil vite build keluar (workspace Jenkins)
                docker cp tmp_vite_build:/var/www/tokoman/public/build ./vite-build-output || true

                # hapus container temporer
                docker rm -f tmp_vite_build || true

                echo "Isi folder vite-build-output:"
                ls -lah vite-build-output || true
                '''
            }
        }

        stage('Build and Deploy Application') {
            steps {
                echo '--- MEMBANGUN IMAGE APLIKASI BARU ---'
                sh 'docker compose build'

                echo '--- MEN-DEPLOY SEMUA LAYANAN ---'
                sh 'docker compose up -d'

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
