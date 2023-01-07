// Load plugins
import helper from "./helper";
import * as Popper from "@popperjs/core";
import dom from "@left4code/tw-starter/dist/js/dom";
import globalConfig from './../../../data/json/config.json';

// Set plugins globally
window.helpers = helper;
window.Popper = Popper;
window.$ = dom;
window.globalConfig = globalConfig;
