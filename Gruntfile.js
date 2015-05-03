/* global module, require */
(function() {
    'use strict';
    module.exports = function(grunt) {
        grunt.initConfig({
            pkg: grunt.file.readJSON('package.json'),
            shell: {
//                phpdoc: {
//                    options: {
//                        stderr: false
//                    },
//                    command: './vendor/bin/phpdoc'
//                },
//                phpunit: {
//                    options: {
//                        stderr: false
//                    },
//                    command: './vendor/bin/phpunit'
//                },
//                phpcpd: {
//                    options: {
//                        stderr: false
//                    },
//                    command: './vendor/bin/phpcpd src/'
//                },
//                phpmd: {
//                    options: {
//                        stderr: false
//                    },
//                    command: './vendor/bin/phpmd src/ xml codesize,controversial,design,naming,unusedcode --reportfile docs/phpmd.xml'
//                },
                phpcs: {
                    options: {
                        stderr: false
                    },
                    command: './vendor/bin/phpcs -s                  --report-file=docs/cs/main.txt    --standard=PSR2 -p -v --error-severity=1 --warning-severity=1 ./src;' +
                             './vendor/bin/phpcs -s --report=source  --report-file=docs/cs/source.txt  --standard=PSR2 -p -v --error-severity=1 --warning-severity=1 ./src;' +
                             './vendor/bin/phpcs -s --report=summary --report-file=docs/cs/summary.txt --standard=PSR2 -p -v --error-severity=1 --warning-severity=1 ./src'
                }
            },
            copy: {
                main: {
                    files: [
                        {
                            expand: true,
                            src: 'src/**',
                            dest: 'dist/'
                        },
                        {
                            expand: false,
                            src: 'wpcpt-helper.php',
                            dest: 'dist/wpcpt-helper.php'
                        }
                    ]
                }
            },
            replace: {
                wpcpt_version: {
                    src: ['dist/**/*.php'],
                    overwrite: true,
                    replacements: [{
                        from: /\{\{@wpcpt_version\}\}/g,
                        to: "<%= pkg.version %>"
                    }]
                }
            }
        });

        grunt.loadNpmTasks('grunt-contrib-copy');
        grunt.loadNpmTasks('grunt-shell');
        grunt.loadNpmTasks('grunt-text-replace');

        function showBanner() {
            grunt.config('dev', grunt.option('dev') || false);

            // This moves the cursor up one line so that the task runner doesn't
            // display the 'Running "default" task' message.
            grunt.log.write("\x1B[1A");

            grunt.log.writeln("********************************************************");
            grunt.log.writeln("** WordPress Custom Post Types Helper                 **");
            grunt.log.writeln("********************************************************");
        }

        grunt.registerTask('default', 'Run the default compilation and minification tasks', function() {
            showBanner();
            grunt.option('force', true);
            grunt.task.run([
                'shell:phpcs'
            ]);
        });

        grunt.registerTask('deploy', 'Copy the source files in to the dist directory and build the documentation', function() {
            showBanner();
            grunt.option('force', true);
            grunt.task.run([
                'copy:main',
                'replace:wpcpt_version'
            ]);
        });
    };
})();