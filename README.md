# WPStarter

![wordpress version support](https://img.shields.io/badge/WordPress-5.0+-blue.svg) ![gutenberg ready](https://img.shields.io/badge/Gutenberg-ready-green.svg) ![development status](https://img.shields.io/badge/Status-beta-red.svg)

A Webpack WordPress Starter Theme for Gutenberg development with webpack, browsersync and SASS support. I'd like to keep a simple flow. As **#Gutenberg** ideas, I just try to bring as much as backend style will bring the same frontend style to match "what you see is what you get" (WYSIWYG).

Some of my code was taken from my older #WordPress base theme - **[wpbase](https://github.com/khoipro/wpbase)**. This project was used with `gulpfile.js`, `livereload ` extension.

## Why choose this starter theme

- It starts with many **code base from Twenty Nineteen**. I'm sure it fits many other #WordPress development and can be used with a production website. A demo will be provide soon.
- It has a **clean folder structure** with comments.
- It has as much as many **example code** to keep you touch **Customizer**, **Widget**, **Custom Gutenberg Block** without installing a separate plugin.

- Author: [khoipro](https://twitter.com/khoiprodotcom)
- License: GPL v3
- State: **Beta**

## Installation

1. Navigation to your `wp-content/themes` folder
2. Clone a theme `git clone https://github.com/khoipro/wpstarter.git your-theme`
3. Navigation to `your-theme`
3. Run `npm install`

## Start Dev

1. Run `npm run build` once
2. Edit `webpack.config.js`, change `URL` param to your local virtual host.
3. Run `npm run start` to start `BrowserSync` at `http://localhost:3000`

## Configuration

### Change a local virtual host

See `webpack.config.js` and edit `URL` param.

## Structure

It has two parts: **Backend** and **Frontend**

## Todo List

- [x] Add base theme from Twenty Nineteen
- [x] Add **Webpack** + **BrowserSync** support
- [x] Add support for Customizer (example module: **Footer**)
- [ ] Add full-width page template
- [ ] Add custom widget example code
- [ ] Add support for custom Gutenberg blocks (example module: **Hero Homepage**)
- [ ] Validate backend/frontend code sync flow
- [ ] Deploy a demo
- [ ] Test with some popular modules
- [ ] Add Unit Test Theme data
- [ ] Release a theme to WordPress.org

## Contribute

I wish to hear more ideas from you and your team. I've share this theme via channel [#gutenideas](https://twitter.com/hashtag/GutenIdeas?src=hash) to ask for more improving, but as many other starter theme, I wish to keep them easy to touch and modify by any WordPress lover.

## Inspiration

- [normalize.css, about reset css](https://github.com/necolas/normalize.css/blob/master/normalize.css)
- [Twenty Nineteen, about WordPress backend and structure](https://github.com/WordPress/twentynineteen)
- [WPScholar, about Webpack flow](https://github.com/wpscholar/)

