const path = require('path');

module.exports = {
    mode: 'development',
    entry: './app/assets/src/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'app/assets/dist'),
    },

    module: {
        rules: [
            {
                test: /\.(scss)$/,
                use: [
                {
                    loader: 'style-loader'
                },
                {
                    loader: 'css-loader'
                },
                {
                    loader: 'postcss-loader',
                    options: {
                    postcssOptions: {
                        plugins: () => [
                        require('autoprefixer')
                        ]
                    }
                    }
                },
                {
                    loader: 'sass-loader'
                }
                ]
            }
        ]
    },
    /*devServer: {
        static: {
            directory: path.join(__dirname),
        },
        compress: true,
        port: 8080,
        liveReload: true,
        open: true,
    },*/
};