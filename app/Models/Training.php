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

    public function favorites()
    {
        return $this->hasMany('App\\Models\\Favorite');
    }

    public function favorite_by()
    {
        return Favorite::where('user_id', Auth::user()->id)->first();
    }

    public function tags()
    {
        return $this->belongsToMany('App\\Models\\Tag');
    }

    public function procedures()
    {
        return $this->hasMany('App\\Models\\Procedure');
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
         return $this->getThumbnailUrl('default');
     }

    /**
     * MQサイズ(120x90)のサムネイルURLを取得する
     * @return string サムネイルURL
     */
     public function getMqdefaultThumbnailUrlAttribute()
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
        if( strcmp($thumbnail_name,'default') != 0
            && strcmp($thumbnail_name, 'mqdefault') != 0
            && strcmp($thumbnail_name, 'hqdefault') != 0
            && strcmp($thumbnail_name, 'sddefault') != 0
            && strcmp($thumbnail_name, 'maxresdefault') != 0 )
           throw new Exception('想定外のサムネイル種類名です');

        $id = $this->getVideoIdFromURL();
        if(isset($id)){
            return "http://img.youtube.com/vi/".$id."/".$thumbnail_name.".jpg";

        }else{
            return "/images/noimage_small.png";
        }

    }

    private function getVideoIdFromURL(){
        parse_str(parse_url($this->video_url, PHP_URL_QUERY), $query);
        if($query == null){
            return null;
        }
        return $query['v'];
    }






}
