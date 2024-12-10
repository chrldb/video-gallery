#!/bin/bash

# Répertoire parent contenant les sous-dossiers
VIDEOS_DIR="videos"

# Parcourir chaque sous-dossier
for dir in "$VIDEOS_DIR"/*/; do
  # Vérifier si le dossier contient au moins un fichier vidéo
  if ls "$dir"*.mp4 1> /dev/null 2>&1; then
    echo "Processing directory: $dir"
    
    # Parcourir chaque fichier MP4 dans le dossier
    for video in "$dir"*.mp4; do
      # Nom de sortie pour le fichier WebP (1 seul thumbnail par dossier)
      output="$dir/thumbnail.webp"

      # Créer la miniature si elle n'existe pas déjà
      if [ ! -f "$output" ]; then
        echo "Generating thumbnail for $video"
        ffmpeg -i "$video" -vf "thumbnail,scale=320:180" -frames:v 1 "$output"
      else
        echo "Thumbnail already exists for $dir"
      fi

      # On s'arrête après avoir généré une miniature pour le dossier
      break
    done
  else
    echo "No MP4 files found in $dir, skipping..."
  fi
done

echo "Thumbnail generation complete!"
