module.exports = function(grunt){
    grunt.initConfig({
        criticalcss: {
            home: {
                options: {
                    url: 'https://jmango360.com/',
                    filename: 'criticalcss/autoptimize_287954396a1e5d0870535e9c0a7e51f5.css',
                    outputfile: 'criticalcss/home-critical.css',
                    ignoreConsole: true
                }
            },
            tour: {
                options: {
                    url: 'https://jmango360.com/product-tour/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/tour-critical.css',
                    ignoreConsole: true
                }
            },
            features: {
                options: {
                    url: 'https://jmango360.com/product-features/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/features-critical.css',
                    ignoreConsole: true
                }
            },
            video: {
                options: {
                    url: 'https://jmango360.com/product-video/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/video-critical.css',
                    ignoreConsole: true
                }
            },
            portfolio: {
                options: {
                    url: 'https://jmango360.com/product-portfolio/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/portfolio-critical.css',
                    ignoreConsole: true
                }
            },
            pricing: {
                options: {
                    url: 'https://jmango360.com/pricing/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/pricing-critical.css',
                    ignoreConsole: true
                }
            },
            about: {
                options: {
                    url: 'https://jmango360.com/company-about-us/',
                    filename: 'criticalcss/autoptimize_db3b266924dfbfb0e5ee3b53e3f9d75e.css',
                    outputfile: 'criticalcss/about-critical.css',
                    ignoreConsole: true
                }
            },
            team: {
                options: {
                    url: 'https://jmango360.com/company-team/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/team-critical.css',
                    ignoreConsole: true
                }
            },
            press: {
                options: {
                    url: 'https://jmango360.com/company-press-releases/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/press-critical.css',
                    ignoreConsole: true
                }
            },
            blog: {
                options: {
                    url: 'https://jmango360.com/company-blog/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/blog-critical.css',
                    ignoreConsole: true
                }
            },
            partner: {
                options: {
                    url: 'https://jmango360.com/partner-overview/',
                    filename: 'criticalcss/autoptimize_96c07775de43eb197b6c303be6971b24.css',
                    outputfile: 'criticalcss/partner-critical.css',
                    ignoreConsole: true
                }
            }
        },
        cssmin: {
            target: {
                files: {
                    'criticalcss/inline.css': 'criticalcss/*-critical.css'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-criticalcss');

    grunt.registerTask('default', ['criticalcss', 'cssmin']);
};
