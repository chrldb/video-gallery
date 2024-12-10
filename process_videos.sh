#!/bin/bash

# Répertoire contenant les dossiers vidéo
VIDEOS_DIR="videos"

# Parcourir chaque sous-dossier dans le répertoire 'videos'
for dir in "$VIDEOS_DIR"/*/; do
    echo "Processing directory: $dir"

    # Vérifier si un fichier vidéo 1080p existe dans le dossier
    for video in "$dir"/*1080p.mp4; do
        if [ -f "$video" ]; then
            # Chemin pour le fichier audio
            audio_file="${video%.mp4}.wav"
            
            # Générer le fichier audio si non présent
            if [ ! -f "$audio_file" ]; then
                echo "Extracting audio from $video"
                ffmpeg -i "$video" -q:a 0 -map a "$audio_file"
            else
                echo "Audio file already exists: $audio_file"
            fi

            # Chemin pour le fichier de transcription
            transcription_file="${video%.mp4}.txt"

            # Effectuer la transcription si le fichier texte n'existe pas encore
            if [ ! -f "$transcription_file" ]; then
                echo "Transcribing $audio_file using Whisper"
                python3 -m whisper "$audio_file" --model base --device cpu --output_dir "$dir"
            else
                echo "Transcription already exists: $transcription_file"
            fi
        else
            echo "No 1080p video found in $dir"
        fi
    done
done

echo "Processing complete!"