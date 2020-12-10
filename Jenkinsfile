pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'docker build -t php-pandoc:static-analysis .'
                sh 'docker build -t php-pandoc:php-8.0 -f docker/Dockerfile-php-8.0 .'
                sh 'docker build -t php-pandoc:php-7.4 -f docker/Dockerfile-php-7.4 .'
            }
        }
        stage('Static Analysis') {
            steps {
                sh 'docker run php-pandoc:static-analysis tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --dry-run'
                sh 'docker run php-pandoc:static-analysis tools/psalm/vendor/bin/psalm --show-info=true'
            }
        }
        stage('Test') {
            steps {
                sh 'docker run php-pandoc:php-8.0 php vendor/bin/phpunit'
                sh 'docker run php-pandoc:php-7.4 php vendor/bin/phpunit'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
