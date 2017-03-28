#!/usr/bin/env groovy

node('master') {
    try {
        stage('build') {
            git url: 'git@github.com:travisobregon/snippets.git'

            // Start services (Let docker-compose build containers for testing)
            sh "./develop up -d"

            // Get composer dependencies
            sh "./develop composer install"

            // Create .env file for testing
            sh 'cp .env.example .env'
            sh 'sed -i "s/APP_ENV=.*/APP_ENV=testing/" .env'
            sh './develop art key:generate'
        }

        stage('test') {
            // sh "./develop art dusk"
            sh "./develop test"
        }

        slackSend color: 'good', message: "Completed ${env.JOB_NAME} (<${env.BUILD_URL}|build ${env.BUILD_NUMBER}>) successfully"
    } catch(error) {
        // Maybe some alerting?
        slackSend color: 'danger', message: "Failed ${env.JOB_NAME} (<${env.BUILD_URL}|build ${env.BUILD_NUMBER}>) - <${env.BUILD_URL}console|click here to see the console output>"
        throw error
    } finally {
        // Spin down containers no matter what happens
        sh "./develop down"
    }
}
