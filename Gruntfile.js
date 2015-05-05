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
            clean: {
                deploy: {
                    src: ['dist/']
                }
            },
            copy: {
                main: {
                    files: [
                        {
                            cwd: 'src/',
                            expand: true,
                            src: '**',
                            dest: 'dist/'
                        }
                    ]
                }
            },
            replace: {
                wpcpt_info: {
                    src: ['dist/**/*.php'],
                    overwrite: true,
                    replacements: [
                        {
                            from: /\{\{@wpcpt_author_email\}\}/g,
                            to: "<%= pkg.author.email %>"
                        },
                        {
                            from: /\{\{@wpcpt_author_full\}\}/g,
                            to: "<%= pkg.author.name %> \<<%= pkg.author.email %>\> (<%= pkg.author.url %>)"
                        },
                        {
                            from: /\{\{@wpcpt_author_name\}\}/g,
                            to: "<%= pkg.author.name %>"
                        },
                        {
                            from: /\{\{@wpcpt_author_url\}\}/g,
                            to: "<%= pkg.author.url %>"
                        },
                        {
                            from: /\{\{@wpcpt_copyright\}\}/g,
                            to: "<%= pkg.copyright %>"
                        },
                        {
                            from: /\{\{@wpcpt_description\}\}/g,
                            to: "<%= pkg.description %>"
                        },
                        {
                            from: /\{\{@wpcpt_homepage\}\}/g,
                            to: "<%= pkg.homepage %>"
                        },
                        {
                            from: /\{\{@wpcpt_license\}\}/g,
                            to: "<%= pkg.license.url %>"
                        },
                        {
                            from: /\{\{@wpcpt_longname\}\}/g,
                            to: "<%= pkg.longname %>"
                        },
                        {
                            from: /\{\{@wpcpt_version\}\}/g,
                            to: "<%= pkg.version %>"
                        }
                    ]
                }
            }
        });

        grunt.loadNpmTasks('grunt-contrib-clean');
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
                'clean:deploy',
                'copy:main',
                'replace:wpcpt_info'
            ]);
        });
    };
})();