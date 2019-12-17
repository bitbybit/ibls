const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
    // mode: 'development',
    resolve: {
        alias: {
        },
    },

    entry: {
        'app': './src/app.js',
    },

    output: {
        path: path.resolve(__dirname, 'public/dist'),
        publicPath: '',
        filename: '[name].js',
    },

    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[id].css"
        }),
    ],

    devtool: 'source-map',

    module: {
        rules: [
            {
                test: /\.vue$/,
                use: 'vue-loader',
            },

            {
                test: /\.scss$/,
                use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                        },

                        {
                            loader: "css-loader",
                            options: {
                                sourceMap: true,
                            },
                        },

                        {
                            loader: 'postcss-loader',
                            options: {
                                plugins: function () {
                                    return [
                                        require('autoprefixer'),
                                    ];
                                },
                            },
                        },

                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true,
                            },
                        },
                ],
            },

            {
                test: /fonts.*\.(eot|ttf|woff|woff2)$/,
                use: 'file-loader?name=fonts/[name].[ext]',
            },

            {
                test: /\.jpg$/,
                use: 'file-loader?name=images/[name].[ext]',
            },

            {
                test: /(\.(png|svg|gif)$)/,
                use: 'url-loader?limit=10000&name=images/[name].[ext]',
            },
        ],
    },
};
