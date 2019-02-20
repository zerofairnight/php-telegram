<?php

namespace Telegram\Types\Traits;

trait Download
{
    /**
     * Download the file.
     *
     * @return mixed
     */
    public function download()
    {
        // ChatPhoto uses $small_file_id or $big_file_id
        // InlineQueryResultCachedPhoto $photo_file_id
        // InlineQueryResultCachedGif $gif_file_id
        // InlineQueryResultCachedMpeg4Gif $mpeg4_file_id
        // InlineQueryResultCachedSticker $sticker_file_id
        // InlineQueryResultCachedDocument $document_file_id
        // InlineQueryResultCachedVideo $video_file_id
        // InlineQueryResultCachedVoice $voice_file_id
        // InlineQueryResultCachedAudio $audio_file_id

        return $this->telegram->downloadFile($this->file_id);
    }
}
