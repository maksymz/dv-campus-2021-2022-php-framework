module.exports = function(grunt) {
    grunt.initConfig({
        less: {
            dev: {
                options: {
                    compress: false,
                    yuicompress: false,
                    optimization: 2,
                    strictImports: true,
                    sourceMap: true,
                    sourceMapFilename: 'web/css/main.css.map', // where file is generated and located
                    sourceMapURL: 'main.css.map', // the complete url and filename put in the compiled css file
                    sourceMapBasepath: 'web', // Sets sourcemap base path, defaults to current working directory.
                    sourceMapRootpath: '/', // adds this path onto the sourcemap filename and less file paths
                },
                files: {
                    "web/css/main.css": "frontend/css/source/main.less"
                }
            },
            prod: {
                options: {
                    compress: false,
                    yuicompress: false,
                    optimization: 2,
                    strictImports: true
                },
                files: {
                    "web/css/main.css": "frontend/css/source/main.less"
                }
            }
        },

        postcss: {
            dev: {
                options: {
                    map: true,
                    processors: [
                        require('autoprefixer')({
                            overrideBrowserslist: ['last 2 versions']
                        })
                    ]
                },
                src: 'web/css/main.css',
                dest: 'web/css/main.min.css'
            },

            prod: {
                options: {
                    processors: [
                        require('autoprefixer')({
                            overrideBrowserslist: ['last 2 versions']
                        }),
                        require('cssnano')()
                    ]
                },
                src: 'web/css/main.css',
                dest: 'web/css/main.min.css'
            }
        },

        image: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'frontend/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'web/images/'
                }]
            }
        },

        copy: {
            dev: {
                expand: true,
                cwd: 'frontend/js',
                src: '**',
                dest: 'web/js/',
            },
        },


        uglify: {
            prod: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'web/js/main.map',
                },
                files: [{
                    expand: true,
                    cwd: 'frontend/js',
                    src: '**/*.js',
                    dest: 'web/js'
                }]
            }
        },


        watch: {
            less: {
                files: ['frontend/css/source/**/*.less'],
                tasks: ['less:dev', 'postcss:dev']
            },
            image: {
                files: 'frontend/images/**/*.{png,jpg,gif}',
                tasks: ['image']
            },
            scripts: {
                files: ['frontend/js/**/*.js', 'frontend/js/*.js'],
                tasks: ['copy']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('@lodder/grunt-postcss');
    grunt.loadNpmTasks('grunt-image');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.registerTask('default', ['less:prod', 'postcss:prod', 'image', 'uglify:prod']);
    grunt.registerTask('dev', ['less:dev', 'postcss:dev', 'image', 'copy:dev', 'watch']);
};
