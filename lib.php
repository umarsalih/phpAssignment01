<?php

//header('Content-type: text/plain');

function display_html_head($title_of_file) {
    echo <<<END
        <html>
            <head>
                <title>
                    $title_of_file
                </title>
            </head>
            <body>

    END;
}

function display_html_foot() {

    echo <<<END
        </body></html>
    END;
}

?>