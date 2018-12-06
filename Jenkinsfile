
pipeline {
    agent none

    stages {

        stage('Build') {
            agent { 
                docker {
                    label 'docker'
                    image "ign/php:5.6"
                    // optimisation composer
                    args '-v $HOME/.composer:/var/composer'
                }
            }
            steps {
		        /* Clean workspace*/
                sh 'rm -rvf *'
                checkout scm 

                /* generate dummy application parameters */
                sh 'cp app/config/parameters.yml.dist app/config/parameters.yml'

                 /* lint PHP sources to find syntax errors */
                sh 'make lint'

                /* install dependencies */
                sh 'composer update --no-interaction'

                /* remove dummy parameters */
                sh 'rm app/config/parameters.yml'

                // save generated files
                stash includes: '**', name: 'app'
            }
        }

        stage('Test'){
            agent {
                label 'docker'
            }
            steps {
                script {
                    unstash 'app'

                    /* build containers and start stack */                    
                    sh 'docker-compose build site'
                    sh 'docker-compose up -d'
                    sh 'docker-compose exec -T site docker/application.sh test'

                    /* extract reports */
                    sh 'rm -rf output'
                    sh 'docker cp gpu-search:/application/output output'

                    /* restart site */
                    sh 'docker-compose restart site'

                    /* publish test results */
                    junit 'output/junit.xml'

                    /* publish coverage results */
                    step([
                        $class: 'CloverPublisher',
                        cloverReportDir: 'output',
                        cloverReportFileName: 'clover.xml'
                    ])
                }
            }
        }

    }
}
