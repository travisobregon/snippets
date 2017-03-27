#!/usr/bin/env groovy

node('master') {
    stage('build') {
        git url: 'git@github.com:travisobregon/snippets.git'

        // Start services (Let docker-compose build containers for testing)
        sh "./develop up -d"

        // Get composer dependencies
        sh "./develop composer install"

        // Create .env file for testing
        sh 'cp .env.example .env'
        sh './develop art key:generate'
    }
    stage('test') {
        sh "./develop art dusk"
        sh "./develop test"
    }
}
