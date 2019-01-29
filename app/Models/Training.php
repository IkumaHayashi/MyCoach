<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;


class Training extends Model
{

    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\\Models\\Tag');
    }

    /**
     * Youtube埋め込みURLを発行する
     *
     * @return string 埋め込みURL
     */
    public function getEmbedVideoUrlAttribute()
    {

        $id = $this->getVideoIdFromURL();
        Log::debug($id);

        if(isset($id)){
            return "https://www.youtube.com/embed/".$id;
        }else{
            return null;
        }
    }

    /**
     * デフォルトサイズ(120x90)のサムネイルURLを取得する
     * @return string サムネイルURL
     */
     public function getDefaultThumbnailUrlAttribute()
     {
         return $this->getThumbnailUrl('mqdefault');
     }

    /**
     * 引数で渡されたサムネイル種類のYoutubeサムネイルのURLを返す
     * @param string $thumbnail_name
     *  サムネイル種類名 mqdefault:320x180
     *                   hqdefault:480:360
     *                   sddefault:640x480
     *                   maxresdefault:1280x720
     * @return string サムネイルURL
     */
    private function getThumbnailUrl($thumbnail_name)
    {
        if( strcmp($thumbnail_name,'mqdefault') != 0
           && strcmp($thumbnail_name, 'mqdefault') != 0
           && strcmp($thumbnail_name, 'mqdefault') != 0
           && strcmp($thumbnail_name, 'mqdefault') != 0 )
           throw new Exception('想定外のサムネイル種類名です');

        $id = $this->getVideoIdFromURL();
        if(isset($id)){
            return "http://img.youtube.com/vi/".$id."/".$thumbnail_name.".jpg";

        }else{
            return "";
        }

    }

    private function getVideoIdFromURL(){
        parse_str(parse_url($this->video_url, PHP_URL_QUERY), $query);
        return $query['v'];
    }






}
