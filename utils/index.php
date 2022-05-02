<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_WARNING);

$valid_audio_files = function () {
    return [
        "mp3",
        "m4a",
        "mp4",
        "aac",
        "wav",
    ];
};

$isAudioFile = function (string $file_name) use ($valid_audio_files): bool {
    $extension = (pathinfo($file_name))['extension'] ?? null;
    return in_array($extension, $valid_audio_files());
};
