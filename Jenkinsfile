pipeline {
    agent any

    environment {
        DOCKER_IMAGE        = 'diwamln/landingpage-vito'
        DOCKER_CREDS        = 'docker-hub'
        GIT_CREDS           = 'token-vito'
        MANIFEST_REPO_URL   = 'github.com/DevopsNaratel/deployment-manifests'
        MANIFEST_TEST_PATH  = 'landingpage-vito/dev/deployment.yaml'
        MANIFEST_PROD_PATH  = 'landingpage-vito/prod/deployment.yaml'
    }

    stages {

        stage('Checkout & Versioning') {
            steps {
                checkout scm
                script {
                    def commitHash = sh(
                        script: 'git rev-parse --short HEAD',
                        returnStdout: true
                    ).trim()

                    env.BASE_TAG = "build-${BUILD_NUMBER}-${commitHash}"
                    currentBuild.displayName = "#${BUILD_NUMBER} (${env.BASE_TAG})"
                }
            }
        }

        stage('Build & Push Docker Image') {
            steps {
                script {
                    docker.withRegistry('', DOCKER_CREDS) {
                        echo "Building Docker image: ${DOCKER_IMAGE}:${env.BASE_TAG}"

                        def appImage = docker.build("${DOCKER_IMAGE}:${env.BASE_TAG}")
                        appImage.push()
                        appImage.push('latest')
                    }
                }
            }
        }

        stage('Update Manifest (DEV / TEST)') {
            steps {
                script {
                    sh 'rm -rf temp_manifests'

                    dir('temp_manifests') {
                        withCredentials([
                            usernamePassword(
                                credentialsId: GIT_CREDS,
                                usernameVariable: 'GIT_USER',
                                passwordVariable: 'GIT_PASS'
                            )
                        ]) {
                            sh """
                                git clone https://${GIT_USER}:${GIT_PASS}@${MANIFEST_REPO_URL} .
                                git config user.email "jenkins@bot.com"
                                git config user.name  "Jenkins Pipeline"

                                sed -i -E 's|image: (docker.io/)?${DOCKER_IMAGE}:.*|image: docker.io/${DOCKER_IMAGE}:${env.BASE_TAG}|g' ${MANIFEST_TEST_PATH}

                                git add .
                                if ! git diff-index --quiet HEAD; then
                                    git commit -m "Deploy landingpage-vito: ${BASE_TAG} [skip ci]"
                                    git push origin main
                                else
                                    echo "No changes detected."
                                fi
                            """
                        }
                    }
                }
            }
        }

        stage('Approval for PROD') {
            steps {
                input(
                    message: 'Aplikasi sudah di-update di DEV. Lanjut update manifest PROD?',
                    ok: 'Promote to PROD'
                )
            }
        }

        stage('Update Manifest (PROD)') {
            steps {
                script {
                    dir('temp_manifests') {
                        withCredentials([
                            usernamePassword(
                                credentialsId: GIT_CREDS,
                                usernameVariable: 'GIT_USER',
                                passwordVariable: 'GIT_PASS'
                            )
                        ]) {
                            sh """
                                git pull origin main

                                sed -i -E 's|image: (docker.io/)?${DOCKER_IMAGE}:.*|image: docker.io/${DOCKER_IMAGE}:${env.BASE_TAG}|g' ${MANIFEST_PROD_PATH}

                                git add .
                                if ! git diff-index --quiet HEAD; then
                                    git commit -m "Promote landingpage-vito to PROD: ${BASE_TAG} [skip ci]"
                                    git push origin main
                                else
                                    echo "No changes detected."
                                fi
                            """
                        }
                    }
                }
            }
        }
    }

    post {
        always {
            sh 'docker image prune -f'
        }
    }
}