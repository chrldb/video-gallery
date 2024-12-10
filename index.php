<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .video-card {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .video-header {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .video-thumbnail {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }
        .video-thumbnail:hover {
            transform: scale(1.05);
        }
        .quality-options, .transcript-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        .btn {
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            font-size: 14px;
            text-align: center;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-download {
            background: #28a745;
        }
        .btn-download:hover {
            background: #1c7e31;
        }
        @media (max-width: 600px) {
            .btn {
                font-size: 12px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Video Gallery</h1>
        <?php
        $directory = 'videos/';
        $videoDirs = glob($directory . '*', GLOB_ONLYDIR); // Liste les sous-dossiers

        if (count($videoDirs) > 0) {
            foreach ($videoDirs as $videoDir) {
                $videoName = basename($videoDir);
                $qualities = glob($videoDir . '/*.mp4');

                // Réordonner les fichiers par qualité croissante
                usort($qualities, function($a, $b) {
                    return (int)preg_replace('/\D/', '', basename($a)) - (int)preg_replace('/\D/', '', basename($b));
                });

                // Ajouter une preview WebP
                $thumbnailPath = $videoDir . '/thumbnail.webp'; // Assurez-vous que chaque dossier contient une thumbnail.webp
                ?>
                <div class="video-card">
                    <div class="video-header"><?php echo htmlspecialchars($videoName); ?></div>
                    <?php if (file_exists($thumbnailPath)): ?>
                        <img class="video-thumbnail" src="<?php echo htmlspecialchars($thumbnailPath); ?>" alt="Preview of <?php echo htmlspecialchars($videoName); ?>">
                    <?php endif; ?>
                    <div class="quality-options">
                        <?php foreach ($qualities as $quality): ?>
                            <?php $qualityName = basename($quality, '.mp4'); ?>
                            <a class="btn btn-download" href="<?php echo htmlspecialchars($quality); ?>" download>
                                Download <?php echo htmlspecialchars($qualityName); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    // Vérifier si un fichier de transcription existe
                    $transcriptionFile = $videoDir . '/' . '1080p' . '.txt';
                    if (file_exists($transcriptionFile)): ?>
                        <div class="transcript-options">
                            <a class="btn btn-download" href="<?php echo htmlspecialchars($transcriptionFile); ?>" download>
                                Download Transcript
                            </a>
                        </div>
                    <?php endif; ?>
                    <div style="margin-top: 10px;">
                        <a class="btn" href="<?php echo htmlspecialchars($qualities[0]); ?>" target="_blank">
                            Stream in Browser
                        </a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No videos found in the 'videos' directory.</p>";
        }
        ?>
    </div>
    <footer style="text-align: center; margin-top: 20px;">
        &copy; 2024 chrldb
    </footer>
</body>
</html>