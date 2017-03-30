#!/usr/bin/env groovy

node('master') {
    try {
        stage('Build') {
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

        stage('Test') {
            sh "./develop test"
        }

        stage('SensioLabsInsight') {
            sh "cp -r ~/.sensiolabs ."
            sh "curl -o insight.phar -s http://get.insight.sensiolabs.com/insight.phar"
            sh "php insight.phar analysis --user-uuid=65dcfd39-5ce9-4b6d-8c0b-c8e9b6ce248b --format=pmd 451e2e8b-c5ac-47bf-8507-56979f5a526c > insight-pmd.xml"
            sh "rm insight.phar"
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
