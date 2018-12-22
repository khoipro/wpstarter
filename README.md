# WPStarter

A Webpack WordPress Starter Theme for Gutenberg development with webpack, browsersync and SASS support.

- Author: [khoipro](https://twitter.com/khoiprodotcom)
- License: GPL v3
- State: **Beta**

![wordpress version support](https://img.shields.io/badge/WordPress-5.0+-blue.svg) ![gutenberg ready](https://img.shields.io/badge/Gutenberg-ready-green.svg) ![development status](https://img.shields.io/badge/Status-beta-red.svg)

## Installation

1. Navigation to your `wp-content/themes` folder
2. Clone a theme `git clone https://github.com/khoipro/wpstarter.git your-theme`
3. Run `npm install`

## Start Dev

1. Run `npm run build` once
2. Run `npm run start` to start BrowserSync

## Configuration

### Change a local virtual host

See `webpack.config.js` and edit `URL` param.

## Structure

It has two parts: **Backend** and **Frontend**

## Todo List

- [x] Add base theme from Twenty Nineteen
- [x] Add Webpack + BrowserSync support
- [x] Add support for Customizer (global modules like Header, Footer)
- [ ] Validate backend/frontend code sync flow
- [ ] Deploy a demo

## Development Flow

I'd like to keep a simple flow. As **#Gutenberg** ideas, I just try to bring as much as backend style will bring the same frontend style to match "what you see is what you get" (WYSIWYG).

