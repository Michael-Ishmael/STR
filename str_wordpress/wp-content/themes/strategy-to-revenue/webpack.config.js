//const HtmlWebpackPlugin = require("html-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
//const GoogleFontsPlugin = require("google-fonts-webpack-plugin")
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const js = {
    test: /\.(js|jsx)$/,
    exclude: /node_modules/,
    use: {
        loader: "babel-loader"
    }
};

const scss = {
    test: /\.(scss|sass)$/,
    use: ["style-loader", "css-loader", "sass-loader"]
};

const img = {
    test: /\.(jpg|png|gif)$/,
    use: {
        loader: "file-loader",
        options: {
            name: "./images/[name].[hash].[ext]"
        },
    },
};

const fonts = {
    test: /\.(woff|woff2|eot|ttf|svg)$/,
    loader: "url-loader?limit=100000",
};


const cssExtract = {
    test: /\.scss$/,
    use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"]
};

const cssOnly = {
    test: /\.css$/,
    use: ["style-loader", "css-loader"]
};

const ts = {
    test: /\.tsx?$/,
    use: 'ts-loader',
    exclude: /node_modules/
};


module.exports = {
    mode: 'development',
    entry: {
        app: "./src/ts/app.ts"
    },
    resolve: {
        modules: ["node_modules"],
        extensions: ['.ts', '.js', '.json']
    },
    module: {
        rules: [cssExtract, js, ts, img, fonts]
    },
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new MiniCssExtractPlugin({
            filename: "[name].css"
        }),
        new BrowserSyncPlugin({
                files: [
                    '**/*.php',
                    '**/*.js',
                    '**/*.scss',
                ]
            }
        )
    ],
    devtool: 'source-map',
    devServer: {
        stats: "errors-only",
        host: process.env.HOST,
        port: process.env.PORT,
        open: true,
        overlay: true,
        historyApiFallback: true

    }
};