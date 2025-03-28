const sass = require('sass');
const { obfuscate } = require("javascript-obfuscator");

// Gruntfile.js is a node module so it can access all the node modules
module.exports = function(grunt){ 

    // Display the current date and time
    var currentdate = new Date(); 
    var datetime = "Last Sync: " + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " @ "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

    // Project configuration.
    grunt.initConfig({
        
        //concatenate files, concating css,js,scss files to project/dist folder
        concat: {

            options: {
            //Defines the string or character that will be inserted between concatenated files.
            separator: '\n', 
            //The source map contains a mapping reference that helps developer tools trace errors or debug the original files.    
            sourceMap: true,   
            //banner This option is used to add a string or a comment at the beginning of the output file.
            banner: "/*Processed by SNA labs on "+datetime+"*/\n" 
            },
        
            css: {
                src: [
                    '../css/**/*.css',
                ],

                dest: 'dist/style.css', 
            },
            
            js: {
                src: [
                    //grunt is a root directory
                    'bower_components/jquery/dist/jquery.js',
                    '../js/**/*.js',
                ],
                    
                dest: 'dist/app.js' 
            },

            scss:{
                src: [
                    '../scss/**/*.scss',
                ],

                dest: 'dist/style.scss', 
            },
            

        },

        //compile the scss to css
        sass: {
            options: {
                implementation: sass, // Use Dart Sass
                sourceMap: true
            },
            dist: {
                options: {
                    style: 'expanded'
                },
                files: {                    
                    '../../htdocs/css/app.css': 'dist/style.scss',  //dst:src & app.css is the scss file
                }
            }
        },

        //minify the css,so it will be faster on loading frontend
        //minify all the css, js, scss files in the dist folder and save it to htdocs respective folders
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            css: {
				files: {
					'../../htdocs/css/style.css': ['dist/style.css'],         
				}
			},
			scss: {
				files: {
					'../../htdocs/css/app.css': ['../../htdocs/css/app.css'],   //minify the scss(app.css) file and save it to htdocs/css/app.css
				}
			}
        },

        //minify the js,so it will be faster on loading frontend
        uglify: {
            minify: {
                files: {
                '../../htdocs/js/app.min.js': ['dist/app.js'] 
                }
            }
        },

        //copy the jquery file from bower_components to htdocs/js/jquery
        copy: {
            jquery: {
                // files: [          
                // // includes files within path and its sub-directories
                // //expand -> It tells Grunt to "expand" the list of files that match the src pattern,
                // //filter -> filters only files, flattens -> Removes the directory structure from the source files.
                // {
                //     expand: true, 
                //     flatten: true,
                //     filter: 'isFile',
                //     src: ['bower_components/jquery/dist/*'], 
                //     dest: '../../htdocs/js/jquery'
                // },
            
                // ],
            },
        },

        obfuscator: {
        options: {
            banner: '// obfuscated with grunt-contrib-obfuscator.\n',
            // debugProtection: true,
            // debugProtectionInterval: true,
            // domainLock: ['photo.selfmade.buzz']
        },
        task1: {
            options: {
                // options for each sub task
            },
            files: {        //destination : source
                '../../htdocs/js/app.o.js': [         
                    'dist/app.js',
                ]
            }
        }
    },
        
    
    watch: {
        css: {
        // `/**/` matches any subdirectories inside css.  `*.css` matches all `.css` files in the css directory and its subdirectories.
            files: [
            '../css/**/*.css',              
        ],
            tasks: ['concat:css','cssmin:css'],
            options: {
            spawn: false,
            },
        },

        scss: {
            files: [
            '../scss/**/*.scss',
            ],
            tasks: ['concat:css','sass','cssmin:scss'],
            options: {
            spawn: false,
            },
        },

        js: {
            files: [
            '../js/**/*.js'       
            
            ],
            tasks: ['concat:js','uglify','obfuscator'],
            options: {
            spawn: false,
            },
        },

        
    },


    });

    // Custom tasks
    grunt.registerTask('hello',function(){
        console.log('Hello World');
    })

    grunt.registerTask('task1',function(){
        console.log('Task 1 is running ...');
    })

    grunt.registerTask('task2',function(){
        console.log('Task 2 is running ...');
    })

    // Load the plugins that provide the tasks.
    grunt.loadNpmTasks('grunt-contrib-obfuscator');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-sass');

    // Default task(s).
    grunt.registerTask('css',['concat:css','cssmin','sass']);
    grunt.registerTask('js',['concat:js','uglify','obfuscator']);
    grunt.registerTask('default',['copy','concat','cssmin:css','sass','cssmin:scss','uglify','obfuscator','watch']);
};