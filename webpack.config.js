const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');

const options = {};

module.exports = [
    /* AppBundle */
    {
        entry: './src/AppBundle/Resources/js/main.js',
        output: {
            path: path.resolve(__dirname, 'web'),
            filename: 'gpu-search.js'
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules//*,
                    use: {
                        loader: "babel-loader"
                    }*/
                }
            ]
        },
        plugins: [
            new CopyWebpackPlugin([
                { from: './node_modules/jquery/dist', to: './vendor/jquery' },
                //{ from: './node_modules/popper.js/dist/umd', to: './vendor/popper.js/' },
                { from: './node_modules/bootstrap/dist', to: './vendor/bootstrap' },
                { from: './node_modules/openlayers/dist', to: './vendor/openlayers'}
                //{ from: './node_modules/material-design-icons/iconfont', to: './vendor/material-design-icons' }
            ], options)
        ]
    }
];