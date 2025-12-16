<?php
namespace App\Http\Traits;

use App\Models\Attachment;
use Laracasts\Flash\Flash;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait AttachmentTrait{

    public static function bootAttachmentTrait(){
        static::saved(function (Model $model) {
            /*if (!request()->hasFile("file")) {
                throw new \Exception('Attached file is required');
            }*/
            $choose_multi_files_allowed = request()->get("choose_multi_files_allowed");
            // dump(request()->get("file_description"));
            // dd(request()->all());
            // if(is_array(request()->file('file'))){
            //     $files = request()->file('file');
            //     $titles = request()->get("file_title");
            //     $categories = request()->get("file_category");
            //     $descriptions = request()->get("file_description");
            //     dump("is array");
            //     dump($titles);
            // }else{
            //     $files = [request()->file('file')];
            //     $titles = [request()->get("file_title")];
            //     $categories = [request()->get("file_category")];
            //     $descriptions = [request()->get("file_description")];
            //     dump("not array");
            // }

            $files = request()->file('file');
            $titles = request()->get("file_title");
            $categories = request()->get("file_category");
            $descriptions = request()->get("file_description");
            $driver_type = config("filesystems.default");
            // dd(request()->file('file'));
            // dd(request()->get("file_title"));

            $uploadDone=false;
            if($files){
                foreach ($files as $key=>$file) {
                    $path = str_replace(
                        [':model', ':id'],
                        [class_basename(static::class), $model->id],
                        config("attachment.path"));
                    // dd($file);
                    try {
                        if($file){
                            $filename = Str::limit(Str::slug($file->getClientOriginalName()), 50) . '_' . time() . '.' . $file->clientExtension();
                            //dd($_path,$path,$file);
                            if( !$titles){
                                $title="";
                            }elseif($titles && $choose_multi_files_allowed){
                                $title=$titles;
                            }else{
                                $title= $titles[$key] ?? $titles[0];
                            }

                            if( !$categories){
                                $category="";
                            }elseif($categories && $choose_multi_files_allowed){
                                $category=$categories;
                            }else{
                                $category= $categories[$key] ?? $categories[0];
                            }

                            if( !$descriptions){
                                $description="";
                            }elseif($descriptions && $choose_multi_files_allowed){
                                $description=$descriptions;
                            }else{
                                $description= $descriptions[$key] ?? $descriptions[0];
                                if( !$description){
                                    $description="";
                                }
                            }

                            if($driver_type == "s3"){
                                $vpath = $file->storeAs(
                                    $path,
                                     $filename,
                                    's3'
                                );
                                $uploadDone=true;
                            }else{
                                $file->storePubliclyAs($path, $filename);
                                $uploadDone=true;
                            }

                            if ($uploadDone){
                                Attachment::create([
                                    'model_type' => static::class,
                                    'model_id' => $model->id,
                                    'path' => $path,
                                    'name' => $filename,
                                    'filename' => Str::limit($file->getClientOriginalName(), 150),
                                    'type' => $file->getMimeType(),
                                    'extension' => $file->clientExtension(),
                                    'size' => $file->getSize(),
                                    'attachment_type_id' => $category,
                                    'title' => $title,
                                    'description' => $description,
                                    'driver_type' => $driver_type
                                ]);
                            }
                        }

                    } catch (\Exception $e) {
                        Flash::error(__('messages.filesNotUploaded'));
                        //   return $e->getMessage();
                    }


                }
            }

            if($uploadDone){
                Flash::success(__('messages.filesUploaded'));
            }
        });
    }
    /**
     * Get the attachments relation morphed to the current model class
     *
     * @return MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'model');
    }


    /**
     * Find an attachment by key
     *
     * @param string $key
     *
     * @return Attachment|null
     */
    public function attachment($uuid)
    {
        return $this->attachments->where('uuid', $uuid)->first();
    }


    /**
     * Find all attachments with the given
     *
     * @param string $group
     *
     * @return Attachment[]|Collection
     */
    public function attachmentsCategory($category)
    {
        return $this->attachments->where('category', $category);
    }

}
