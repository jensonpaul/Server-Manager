 <link href='http://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css'><style>
                    html, body {
                        margin: 0;
                        padding: 0;
                        width: 100%;
                        height: 100%;
                    }
                        body {
                            color: #f0f0f0;

                            tab-size: 4;
                        }

                    ::-moz-selection{background: #662039 !important; color: #fff !important; text-shadow: none;}
                    ::selection {background: #662039 !important; color: #fff !important; text-shadow: none;}

                    a,
                    .error-stack-trace-line {
                        -webkit-transition: color 120ms linear, background 120ms linear;
                           -moz-transition: color 120ms linear, background 120ms linear;
                            -ms-transition: color 120ms linear, background 120ms linear;
                             -o-transition: color 120ms linear, background 120ms linear;
                                transition: color 120ms linear, background 120ms linear;
                    }

                    a,
                    a:visited,
                    a:hover,
                    a:active {
                        color: #9ae;
                        text-decoration: none;
                    }
                    a:hover,
                    a.error-editor-link:hover {
                        color: #aff;
                    }
                    a.error-editor-link,
                    a.error-editor-link:visited,
                    a.error-editor-link:active {
                        color: inherit;
                    }

                    h2,
                    #error-editor .ace_line,
                    #error-editor .ace_editor,
                    #error-editor .ace_gutter,
                    .background {
                        font-size: 16px;
                        font-family: inconsolata, 'Droid Sans Mono', "DejaVu Sans Mono", consolas, monospace;
                    }
                    #error-editor .ace_line,
                    #error-editor .ace_editor,
                    #error-editor .ace_gutter,
                    .background {
                        line-height: 18px;
                    }
                    #error-editor.no-line-nums .ace_gutter {
                        display: none;
                    }

                    h1,
                    h2 {
                        font-family: "Segoe UI Light","Helvetica Neue",'RobotoLight',"Segoe UI","Segoe WP",sans-serif;
                        font-weight: 100;
                        line-height: normal;
                    }
                    h1 {
                        font-size: 42px;
                        margin-bottom: 0;
                    }
                    h2 {
                        font-size: 28px;
                        margin-top: 0;
                    }
                            .background {
                                width: 100%;
                                background: #111;

                                padding: 18px 24px;
                                -moz-box-sizing: border-box;
                                box-sizing: border-box;

                                /*
                                 * Take over the page via CSS,
                                 * so we block anything already rendered.
                                 */
                                position: fixed;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;

                                z-index: 100000;

                                height: 100%;
                                overflow: auto;
                            }
                    html.ajax {
                        background: transparent;
                    }
                        html.ajax > body {
                            background: rgba( 0, 0, 0, 0.3 );
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;

                            padding: 30px 48px;
                        }
                            html.ajax > body > .background {
                                border-radius: 4px;
                                box-shadow: 5px 8px 18px rgba( 0, 0, 0, 0.4 );

                                height: auto;
                                min-height: 0;

                                overflow: hidden;

                                position: relative;
                                top: auto;
                                left: auto;
                                right: auto;
                                bottom: auto;
                            }

                    #ajax-info,
                    .ajax-button {
                        font-size: 26px;
                    }
                    #ajax-info {
                        display: none;
                        position: relative;
                        line-height: 100%;

                        white-space: nowrap;
                    }
                        html.ajax #ajax-info {
                            display: block;
                        }
                        html.ajax #error-file-root {
                            display: none;
                        }
                    .ajax-button {
                        padding: 2px 12px 5px 12px;
                        margin-top: -3px;
                        border-radius: 3px;
                        color: #bbb;
                        font-weight: 400;
                    }
                    .ajax-button,
                    .ajax-button:visited,
                    .ajax-button:active,
                    .ajax-button:hover {
                        text-decoration: none;
                    }
                    a.ajax-button:hover {
                        color: #fff;
                    }
                    #ajax-tab {
                        float: left;
                        margin-right: 12px;

                        background: #000;
                        color: inherit;
                        border: 1px solid #333;
                        box-shadow: 0 0 2px #222;
                        margin-top: -4px;
                    }
                    .ajax-buttons {
                        position: absolute;
                        right: 0;
                        top: 0;
                    }
                        #ajax-retry {
                            float: right;
                            background: #0E4973;

                            margin-right: 12px;
                        }
                            #ajax-retry:hover {
                                background: #0C70B7;
                            }
                        #ajax-close {
                            float: right;
                            background: #622;
                        }
                            #ajax-close:hover {
                                background: #aa4040;
                            }

                    #error-title {
                        margin-top: 6px;
                        position: relative;
                        white-space: pre-wrap;
                    }

                                        #error-wrap {
                        right: 0;
                        top: 0;
                        position: absolute;

                        width : 100%;
                        height: 0;
                    }
                    #error-back {
                        font-size: 240px;
                        color: #211600;
                        position: absolute;
                        top: 60px;
                        right: -40px;

                        -webkit-transform: rotate( 24deg );
                           -moz-transform: rotate( 24deg );
                            -ms-transform: rotate( 24deg );
                             -o-transform: rotate( 24deg );
                                transform: rotate( 24deg );
                    }

                                        .error-file-top.has_code {
                        position: relative;
                        height: 42px;
                        margin: 16px 0 3px 0;
                    }
                        .error-file-top > h2 {
                            position: absolute;

                            left: 0;
                            right: 129px;
                            bottom: 0;

                            margin: 0;
                        }
                        .error-file-top.has_code > h2 {
                            bottom: 3px;
                            left: 167px;
                        }

                        .error-file-save {
                            position: absolute;
                            right: 0;
                            bottom: 0;
                            width: 160px;
                            line-height: 36px;

                            text-align: center;

                            color: #555;
                            border: 1px solid #555;

                            border-radius: 3px;

                            -webkit-transition: color 200ms linear, border-color 200ms linear;
                            -moz-transition: color 200ms linear, border-color 200ms linear;
                            transition: color 200ms linear, border-color 200ms linear;
                        }
                        .error-file-save,
                        .error-file-save:active,
                        .error-file-save:visited,
                        .error-file-save:hover {
                            text-decoration: none;

                            color: #555;
                            border-color: #555;
                        }
                        .error-file-save:hover {
                            color: #fff;
                            border-color: #fff;
                        }

                        #error-linenumber {
                            position: absolute;
                            text-align: right;
                            right: 101%;
                            width: 178px;
                        }
                    #ajax-info,
                    #error-file-root {
                        color: #666;
                    }
                    #error-file-root {
                        position: relative;
                    }
                    #error-files {
                        line-height: 0;
                        font-size: 0;

                        position: relative;
                        padding: 9px 0 36px 0;

                        display: inline-block;

                        width: 100%;
                        -moz-box-sizing: border-box;
                        box-sizing: border-box;
                        padding-left: 166px;

                        overflow: hidden;
                    }
                        /**
                         * Two transitions are used to get them to smoothly fade,
                         * in both directions.
                         *
                         * The second keeps it on screen for long enough for the
                         * fade to occur, and then does the margin transtion to move
                         * it out.
                         */
                        .error-file-lines {
                            display: inline-block;
                            opacity: 0;

                            float: left;
                            clear: none;

                            width: 100%;
                            margin-right: -100%;

                            -webkit-transition: opacity 300ms;
                               -moz-transition: opacity 300ms;
                                -ms-transition: opacity 300ms;
                                 -o-transition: opacity 300ms;
                                    transition: opacity 300ms;
                        }
                        .error-file-lines.show {
                            height: auto;

                            opacity: 1;

                            margin: 0;

                            -webkit-transition: opacity 300ms, margin 100ms linear 300ms;
                               -moz-transition: opacity 300ms, margin 100ms linear 300ms;
                                -ms-transition: opacity 300ms, margin 100ms linear 300ms;
                                 -o-transition: opacity 300ms, margin 100ms linear 300ms;
                                    transition: opacity 300ms, margin 100ms linear 300ms;
                        }
                            .error-file-line {
                                line-height: 21px;

                                font-size: 16px;

                                color: #ddd;
                                list-style-type: none;

                                /* needed for empty lines */
                                min-height: 20px;
                                padding-right: 18px;
                                padding-bottom: 1px;

                                box-sizing: border-box;
                                padding-left: 166px;

                                border-radius: 2px;

                                display: inline-block;
                                float: left;
                                clear: both;

                                position: relative;

                                /* Chrome fix */
                                min-width: 50%;
                            }
                                .error-file-line-number {
                                    position: absolute;
                                    top: 0;
                                    right: 100%;
                                    margin-right: 12px;
                                    display: block;
                                    text-indent: 0;
                                    text-align: left;
                                }

                    #error-editor {
                        width: 100%;

                        position: relative;
                        
                        margin: 0 0 36px 0;
                    }
                    #error-editor {
                        height: 450px;
                    }
                        #noscript-editor {
                            width: 100%;
                            line-height: 400px;
                            font-size: 32px;
                            text-align: center;
                        }
                        #error-editor-ace {
                            top: 0;
                            bottom: 0;
                            left : 0;
                            right: 0;
                        }
                                #error-editor-ace.ace_editor > .ace_gutter {
                                    background: transparent;
                                    color: #555;
                                }
                                #error-editor-ace.ace_editor .ace_print_margin_layer {
                                    display: none;
                                }
                                #error-editor-ace.ace_editor .ace_indent-guide {
                                    background: none;
                                }
                                #error-editor-ace.ace_editor .ace_scroller {
                                    background-color: #111;
                                }
                                #error-editor-ace.ace_editor .ace_text-layer {
                                    color: #F8F8F8;
                                }
                                #error-editor-ace.ace_editor .ace_cursor {
                                    border-left: 2px solid #A7A7A7;
                                }
                                #error-editor-ace.ace_editor .ace_cursor.ace_overwrite {
                                    border-left: 0px;
                                    border-bottom: 1px solid #A7A7A7;
                                }
                                #error-editor-ace.ace_editor .ace_marker-layer .ace_selection {
                                    background: rgba(221, 240, 255, 0.20);
                                }
                                #error-editor-ace.ace_editor.multiselect .ace_selection.start {
                                    box-shadow: 0 0 3px 0px #141414;
                                    border-radius: 2px;
                                }
                                #error-editor-ace.ace_editor .ace_marker-layer .ace_step {
                                    background: rgb(102, 82, 0);
                                }
                                #error-editor-ace.ace_editor .ace_marker-layer .ace_bracket {
                                    margin: -1px 0 0 -1px;
                                    border: 1px solid rgba(255, 255, 255, 0.25);
                                }
                                #error-editor-ace.ace_editor .ace_marker-layer .ace_active_line {
                                    background: rgba(255, 255, 255, 0.031);
                                }
                                #error-editor-ace.ace_editor .ace_gutter_active_line {
                                    background-color: rgba(255, 255, 255, 0.031);
                                }
                                #error-editor-ace.ace_editor .ace_marker-layer .ace_selected_word {
                                    border: 1px solid rgba(221, 240, 255, 0.20);
                                }
                                #error-editor-ace.ace_editor .ace_invisible {
                                    color: rgba(255, 255, 255, 0.25);
                                }
                                #error-editor-ace.ace_editor .ace_identifier {
                                    color: #F9EE98; 
                                }
                                #error-editor-ace.ace_editor .ace_keyword,
                                #error-editor-ace.ace_editor .ace_meta {
                                    color:#C07041;
                                }
                                #error-editor-ace.ace_editor .ace_constant,
                                #error-editor-ace.ace_editor .ace_constant.ace_other {
                                    color:#cF5d33;
                                }
                                #error-editor-ace.ace_editor .ace_constant.ace_character,  {
                                    color:#CF6A4C;
                                }
                                #error-editor-ace.ace_editor .ace_constant.ace_character.ace_escape,  {
                                    color:#CF6A4C;
                                }
                                #error-editor-ace.ace_editor .ace_invalid.ace_illegal {
                                    color:#F8F8F8;
                                    background-color:rgba(86, 45, 86, 0.75);
                                }
                                #error-editor-ace.ace_editor .ace_invalid.ace_deprecated {
                                    text-decoration:underline;
                                    font-style:italic;
                                    color:#D2A8A1;
                                }
                                #error-editor-ace.ace_editor .ace_support {
                                    color:#9B859D;
                                }
                                #error-editor-ace.ace_editor .ace_support.ace_constant {
                                    color:#CF6A4C;
                                }
                                #error-editor-ace.ace_editor .ace_fold {
                                    background-color: #AC885B;
                                    border-color: #F8F8F8;
                                }
                                #error-editor-ace.ace_editor .ace_support.ace_function {
                                    color:#DAD085;
                                }
                                #error-editor-ace.ace_editor .ace_storage {
                                    color:#F9EE98;
                                }
                                #error-editor-ace.ace_editor .ace_variable {
                                    color:#AC885B;
                                }
                                #error-editor-ace.ace_editor .ace_string {
                                    color:#7C9D5D;
                                }
                                #error-editor-ace.ace_editor .ace_string.ace_regexp {
                                    color:#E9C062;
                                }
                                #error-editor-ace.ace_editor .ace_comment {
                                    font-style:italic;
                                    color:#5F5A60;
                                }
                                #error-editor-ace.ace_editor .ace_variable {
                                    color:#798aA0;
                                }
                                #error-editor-ace.ace_editor .ace_xml_pe {
                                    color:#494949;
                                }
                                #error-editor-ace.ace_editor .ace_meta.ace_tag {
                                    color:#AC885B;
                                }
                                #error-editor-ace.ace_editor .ace_entity.ace_name.ace_function {
                                    color:#AC885B;
                                }
                                #error-editor-ace.ace_editor .ace_markup.ace_underline {
                                    text-decoration:underline;
                                }
                                #error-editor-ace.ace_editor .ace_markup.ace_heading {
                                    color:#CF6A4C;
                                }
                                #error-editor-ace.ace_editor .ace_markup.ace_list {
                                    color:#F9EE98;
                                }
                                .ace_sb::-webkit-scrollbar {
                                    background: #111;
                                    border: 1px solid #333;
                                    border-radius: 2px;
                                }
                                .ace_sb::-webkit-scrollbar-thumb {
                                    background: #333;
                                }
                                .ace_sb::-webkit-scrollbar-corner {
                                    width: 0;
                                    height: 0;
                                }

                    .error-editor-file {
                        display: none;
                    }
                                        #error-stack-trace,
                    .error-stack-trace-line {
                        border-spacing: 0;
                        width: 100%;
                    }
                    #error-stack-trace {
                        position: relative;

                        line-height: 28px;
                        cursor: pointer;
                    }
                        .error-stack-trace-exception {
                            color: #b33;
                        }
                            .error-stack-trace-exception > td {
                                padding-top: 18px;
                            }
                        .error-stack-trace-line {
                            float: left;
                        }
                        .error-stack-trace-line.is-exception {
                            margin-top: 18px;
                            border-top: 1px solid #422;
                        }
                            .error-stack-trace-line:first-of-type > td:first-of-type {
                                border-top-left-radius: 2px;
                            }
                            .error-stack-trace-line:first-of-type > td:last-of-type {
                                border-top-right-radius: 2px;
                            }
                            .error-stack-trace-line:last-of-type > td:first-of-type {
                                border-bottom-left-radius: 2px;
                            }
                            .error-stack-trace-line:last-of-type > td:last-of-type {
                                border-bottom-right-radius: 2px;
                            }

                            .error-stack-trace-line > td {
                                padding: 3px 0;
                                vertical-align: top;
                            }
                            .error-stack-trace-line > .linenumber,
                            .error-stack-trace-line > .filename,
                            .error-stack-trace-line > .file-internal-php,
                            .error-stack-trace-line > .lineinfo {
                                padding-left:  18px;
                                padding-right: 12px;
                            }
                            .error-stack-trace-line > .linenumber,
                            .error-stack-trace-line > .file-internal-php,
                            .error-stack-trace-line > .filename {
                                white-space: pre;
                            }
                            .error-stack-trace-line > .linenumber {
                                text-align: right;
                            }
                            .error-stack-trace-line > .file-internal-php,
                            .error-stack-trace-line > .filename {
                            }
                            .error-stack-trace-line > .lineinfo {
                                width: 100%; /* fix for chrome */
                                padding-right:18px;
                                padding-left: 82px;
                                text-indent: -64px;
                            }
                                        .error-dumps {
                        position: relative;

                        margin-top: 48px;
                        padding-top: 32px;
                        width: 100%;
                        max-width: 100%;
                        overflow: hidden;
                    }
                        .error_dump {
                            float: left;
                            clear: none;

                            -moz-box-sizing: border-box;
                            box-sizing: border-box;

                            padding: 0 32px 24px 12px;
                            max-width: 100%;
                        }
                        .error_dump.dump_request {
                            clear: left;
                            max-width: 50%;
                            min-width: 600px;
                        }
                        .error_dump.dump_response {
                            max-width: 50%;
                            min-width: 600px;
                        }
                        .error_dump.dump_server {
                            width: 100%;
                            clear: both;
                        }
                        .error_dump_header {
                            color: #eb4;
                            margin: 0;
                            margin-left: -6px;
                        }
                        .error_dump_key,
                        .error_dump_mapping,
                        .error_dump_value {
                            white-space: pre;
                            padding: 3px 6px 3px 6px;
                            float: left;
                        }
                        .error_dump_key {
                            clear: left;
                        }
                        .error_dump_mapping {
                            padding: 3px 12px;
                        }
                        .error_dump_value {
                            clear: right;
                            white-space: normal;
                            max-width: 100%;
                        }

                                        .pre-highlight,
                    .highlight {
                    }
                    .is-native,
                    .pre-highlight {
                        opacity: 0.3;
                        color: #999;
                    }
                    .is-native {
                        opacity: 0.3 !important;
                    }
                    .highlight,
                    .pre-highlight.highlight,
                    .highlight ~ .pre-highlight {
                        color: #eee;
                        opacity: 1;
                    }

                    .select-highlight {
                        background: #261313;
                    }
                    .select-highlight.is-native {
                        background: #222;
                    }
                    .highlight {
                        background: #391414;
                    }
                    .highlight.select-highlight {
                        background: #451915;
                    }

                    .pre-highlight span,
                    .pre-highlight:not(.highlight):first-of-type span {
                        color : #999;
                        border: none !important;
                    }

                                        .pre-highlight:first-of-type .syntax-class,
                    .highlight ~ .pre-highlight  .syntax-class,
                    .pre-highlight.highlight     .syntax-class,
                                                 .syntax-class {
                        color: #C07041;
                    }
                    .pre-highlight:first-of-type .syntax-function,
                    .highlight ~ .pre-highlight  .syntax-function,
                    .pre-highlight.highlight     .syntax-function,
                                                 .syntax-function {
                        color: #F9EE98;
                    }
                    .pre-highlight:first-of-type .syntax-literal,
                    .highlight ~ .pre-highlight  .syntax-literal,
                    .pre-highlight.highlight     .syntax-literal,
                                                 .syntax-literal {
                        color: #cF5d33;
                    }
                    .pre-highlight:first-of-type .syntax-string,
                    .highlight ~ .pre-highlight  .syntax-string,
                    .pre-highlight.highlight     .syntax-string,
                                                 .syntax-string {
                        color: #7C9D5D;
                    }
                    .pre-highlight:first-of-type .syntax-variable-not-important,
                    .highlight ~ .pre-highlight  .syntax-variable-not-important,
                    .pre-highlight.highlight     .syntax-variable-not-important,
                                                 .syntax-variable-not-important {
                        opacity: 0.5;
                    }
                    .pre-highlight:first-of-type .syntax-higlight-variable,
                    .highlight ~ .pre-highlight  .syntax-higlight-variable,
                    .pre-highlight.highlight     .syntax-higlight-variable,
                                                 .syntax-higlight-variable {
                        color: #f00;
                        border-bottom: 3px dashed #c33;
                    }
                    .pre-highlight:first-of-type .syntax-variable,
                    .highlight ~ .pre-highlight  .syntax-variable,
                    .pre-highlight.highlight     .syntax-variable,
                    .syntax-variable {
                        color: #798aA0;
                    }
                    .pre-highlight:first-of-type .syntax-keyword,
                    .highlight ~ .pre-highlight  .syntax-keyword,
                    .pre-highlight.highlight     .syntax-keyword,
                    .syntax-keyword {
                        color: #C07041;
                    }
                    .pre-highlight:first-of-type .syntax-comment,
                    .highlight ~ .pre-highlight  .syntax-comment,
                    .pre-highlight.highlight     .syntax-comment,
                    .syntax-comment {
                        color: #5a5a5a;
                    }

                                        .file-internal-php {
                        color: #555 !important;
                    }
                    .pre-highlight:first-of-type .file-common,
                    .highlight ~ .pre-highlight  .file-common,
                    .pre-highlight.highlight     .file-common,
                                                 .file-common {
                        color: #eb4;
                    }
                    .pre-highlight:first-of-type .file-ignore,
                    .highlight ~ .pre-highlight  .file-ignore,
                    .pre-highlight.highlight     .file-ignore,
                                                 .file-ignore {
                        color: #585;
                    }
                    .pre-highlight:first-of-type .file-app,
                    .highlight ~ .pre-highlight  .file-app,
                    .pre-highlight.highlight     .file-app,
                                                 .file-app {
                        color: #66c6d5;
                    }
                    .pre-highlight:first-of-type .file-root,
                    .highlight ~ .pre-highlight  .file-root,
                    .pre-highlight.highlight     .file-root,
                                                 .file-root {
                        color: #b69;
                    }
                </style>
                <div class="background">                                <div id="error-wrap">
                                    <div id="error-back">IntISP</div>
                                </div>
                            
                            <h2 id="error-file-root">A problem has been detected with the Server.</h2>
                              <h1 id="error-title">Debugging has been <span class="syntax-variable">disabled</span> so sensitive server info has been hidden.
                      </h1> <span id="error-filename" class="file-common">If you would like to see error info. Please turn on debugging by editing the config.php file.</span><br>
                       <span id="error-filename" class="file-common">If you are a user of this system please contact the system administrator for further assistance.</span>
 