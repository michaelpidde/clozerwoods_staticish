<?php

const SOURCE = 'source' . DIRECTORY_SEPARATOR;
const TEMPLATE = SOURCE . 'template' . DIRECTORY_SEPARATOR;
const GENERATED = 'public' . DIRECTORY_SEPARATOR;
const GENERATED_AT = GENERATED . 'generated_at.txt';

function content_generated_time(): int {
    $content_generated_time = 0;
    if(file_exists(GENERATED_AT)) {
        $content_generated_time = filemtime(GENERATED_AT);
    }
    return $content_generated_time;
}

function this_generator_is_modified(): bool {
    ;
    if(filemtime(__FILE__) > content_generated_time()) {
        echo "Generator has been modified. Regenerating all content.\n";
        return true;
    }

    return false;
}

function template_is_modified(): bool {
    $content_generated_time = content_generated_time();

    $template_files = [
        TEMPLATE . 'header.php',
        TEMPLATE . 'footer.php',
    ];
    foreach($template_files as $template_file) {
        if(filemtime($template_file) > $content_generated_time) {
            echo "Template has been modified. Regenerating all content.\n";
            return true;
        }
    }

    return false;
}

function should_generate(string $source_file, string $generated_file) {
    $content_generated_time = 0;
    if(file_exists($generated_file)) {
        $content_generated_time = filemtime($generated_file);
    }

    $modified_time = filemtime($source_file);

    if($modified_time <= $content_generated_time) {
        return false;
    }

    return true;
}

function generate(string $source_file, string $generated_file, string $data_file = '', bool $build_all = false): string {
    $data_file_changed = false;
    if($data_file) {
        $data_file_changed = should_generate($data_file, $generated_file);
    }

    if(!$build_all && !$data_file_changed && !should_generate($source_file, $generated_file)) {
        return '';
    }

    ob_start();
    require $source_file;
    $content = ob_get_clean();

    file_put_contents($generated_file, $content);

    return "Generated {$generated_file}\n";
}

function copy_static_files(): string {
    $message = '';
    $static_files = glob(TEMPLATE . 'static/*');
    foreach($static_files as $static_file) {
        $static_file = basename($static_file);
        if(should_generate(TEMPLATE . 'static' . DIRECTORY_SEPARATOR . $static_file, GENERATED . $static_file)) {
            copy(TEMPLATE . 'static' . DIRECTORY_SEPARATOR . $static_file, GENERATED . $static_file);
            $message .= "Copied {$static_file}\n";
        }
    }
    return $message;
}

function generate_pages(bool $build_all): string {
    $message = '';
    $pages = glob(SOURCE . 'pages/*.php');
    foreach($pages as $page) {
        $file_name_no_extension = basename($page, '.php');
        $data_file = '';
        if(file_exists(SOURCE . 'pages' . DIRECTORY_SEPARATOR . $file_name_no_extension . '.json')) {
            $data_file = SOURCE . 'pages' . DIRECTORY_SEPARATOR . $file_name_no_extension . '.json';
        }
        $message .= generate($page, GENERATED . "{$file_name_no_extension}.htm", $data_file, $build_all);
    }
    return $message;
}

function copy_proxy(): string {
    $message = '';
    if(should_generate(SOURCE . 'proxy.php', GENERATED . 'index.php')) {
        copy(SOURCE . 'proxy.php', GENERATED . 'index.php');
        $message = "Copied proxy.php to index.php\n";
    }
    return $message;
}

function run(): void {
    if(content_generated_time() == 0) {
        echo "Generation timestamp missing. Regenerating all content.\n";
        $build_all = true;
    } else {
        $build_all = this_generator_is_modified() || template_is_modified();
    }

    echo copy_static_files();
    echo generate_pages($build_all);
    echo copy_proxy();

    file_put_contents(GENERATED_AT, time());
}

run();