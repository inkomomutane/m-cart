<?php

foreach (new FilesystemIterator(__DIR__.'/admin') as $fileinfo) {
    require $fileinfo->getPathname();
}

foreach (new FilesystemIterator(__DIR__.'/web') as $fileinfo) {
    require $fileinfo->getPathname();
}
require __DIR__.'/auth.php';
