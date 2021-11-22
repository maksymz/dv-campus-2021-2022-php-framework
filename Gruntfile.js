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
    });

    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('default', ['less:prod']);
    grunt.registerTask('dev', ['less:dev']);
};
