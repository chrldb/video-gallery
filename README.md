

# Video Gallery with Transcriptions

This project is a simple PHP-based video gallery that allows users to:
- Browse and download videos of different qualities.
- Stream videos in the browser.
- Download transcripts (if available) for the `1080p` version.

## Features

- **Responsive Design**: User-friendly layout for desktop and mobile.
- **Automatic Transcriptions**: A script processes `1080p` videos to generate audio and transcriptions.
- **Download Options**: Videos and transcripts are downloadable.

## Requirements

### Server
- PHP 7.4 or newer
- FFmpeg installed on the server
- Python 3.x with OpenAI Whisper installed (`pip install git+https://github.com/openai/whisper.git`)

### Client
- A modern browser (e.g., Chrome, Firefox)

## Installation

1. Clone the repository:

```bash
   git clone https://github.com/yourusername/video-gallery.git
   cd video-gallery
```
2.	Ensure FFmpeg and Whisper are installed:

```bash
sudo apt install ffmpeg
python3 -m pip install git+https://github.com/openai/whisper.git
```

3.	Place your videos in the videos/ folder. Videos should follow this structure:

```plaintext
videos/
├── video1/
│   ├── 1080p.mp4
│   ├── 720p.mp4
│   └── ...

```
4.	Run the Bash script to process videos:

```bash
./process_1080p_videos.sh
```

5.	Deploy the index.php file to your web server.
6.	Open the site in a browser and enjoy your video gallery!

## Usage

	•	Videos are listed in the gallery with their available qualities.
 
	•	Transcriptions can be downloaded if they exist for the 1080p version.

## Contributing

Feel free to fork the project and submit pull requests for improvements.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

### Instructions pour GitHub

1. **Create a GitHub repository** :
   - Go to [GitHub](https://github.com/) and create a new repository.
   - Name it `video-gallery`.

2. **Add files to the repository** :
   In your terminal :
```bash
   git init
   git add .
   git commit -m "Initial commit"
   git branch -M main
   git remote add origin https://github.com/yourusername/video-gallery.git
   git push -u origin main

```

3. **Add videos** :

	- Place your videos in the videos/ directory locally.

	- Process them with process_videos.sh.
