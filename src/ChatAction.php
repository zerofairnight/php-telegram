<?php

namespace Telegram;

class ChatAction
{
    /**
     * Sets chat status as Typing.
     *
     * @var string
     */
    const TYPING = 'typing';

    /**
     * Sets chat status as Sending Photo.
     *
     * @var string
     */
    const UPLOAD_PHOTO = 'upload_photo';

    /**
     * Sets chat status as Sending Video.
     *
     * @var string
     */
    const UPLOAD_VIDEO = 'upload_video';

    /**
     * Sets chat status as Sending Audio.
     *
     * @var string
     */
    const UPLOAD_AUDIO = 'upload_audio';

    /**
     * Sets chat status as Sending Document.
     *
     * @var string
     */
    const UPLOAD_DOCUMENT = 'upload_document';

    /**
     * Sets chat status as Sending Video Note.
     *
     * @var string
     */
    const UPLOAD_VIDEO_NOTE = 'upload_video_note';

    /**
     * Sets chat status as Choosing Geo.
     *
     * @var string
     */
    const FIND_LOCATION = 'find_location';

    /**
     * Sets chat status as Recording Video.
     *
     * @var string
     */
    const RECORD_VIDEO = 'record_video';

    /**
     * Sets chat status as Recording Audio.
     *
     * @var string
     */
    const RECORD_AUDIO = 'record_audio';

    /**
     * Sets chat status as Recording Video Note.
     *
     * @var string
     */
    const RECORD_VIDEO_NOTE = 'record_video_note';
}
