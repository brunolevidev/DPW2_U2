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
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
                ],
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