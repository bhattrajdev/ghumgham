<?php

namespace App\Traits;

use App\Enums\ImageType;
use App\Http\Requests\Admin\ImageRequest;
use App\Jobs\WaterMark;
use App\Models\PolyImage;
use App\Models\Seo;
use Illuminate\Support\Str;


trait UploadFileTrait
{

    public function storeCoverImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->storeImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_COVER);
    }


    public function storeIconImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->storeImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_ICON);
    }

    public function storeMetaImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->storeImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_META);
    }

    public function storeFeatureImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        $feature = $this->storeImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_FEATURE);
        if (method_exists(static::class, "seo")) {
            $this->seo()->create([
                "title" => $alt_text,
                "keywords" => $alt_text,
                "description" => $alt_text,
                "image_id" => $feature->id
            ]);
        }
        return $feature;
    }

    public function storeGalleryImage(ImageRequest $imageRequest, $name = "image", $optimize = true, $watermark = true): PolyImage
    {
        return $this->storeImage($imageRequest->file($name), $imageRequest->alt, true, true, ImageType::TYPE_GALLERY, $imageRequest->order);
    }

    public function storeDocImage(ImageRequest $imageRequest, $name = "image", $optimize = true, $watermark = true): PolyImage
    {
        return $this->storeImage($imageRequest->file($name), $imageRequest->alt, true, true, ImageType::TYPE_DOCS, $imageRequest->order);
    }

    public function updateIconImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_ICON);
    }

    public function updateMetaImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_META);
    }

    public function updateCoverImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_COVER);
    }

    public function updateFeatureImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_FEATURE);
    }

    public function updateGalleryImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_GALLERY);
    }

    public function updateDocImage(string $alt_text, $file, $optimize = true, $watermark = true): PolyImage
    {
        return $this->updateImage($file, $alt_text, $optimize, $watermark, ImageType::TYPE_DOCS);
    }

    public function deleteImage(string $field): static
    {
        $folder_name = $this->getFolderName();
        if (isset($this->{$field})) {
            @unlink('uploaded_images/' . $folder_name . '/' . $this->{$field});
        }
        return $this;
    }

    private function storeImage($file, $alt_text = "", $optimize, $watermark, ImageType $type, $order = 1)
    {
        if ($alt_text == "") {
            $alt_text = $file->getClientOriginalName();
        }
        $folder_name = $this->getFolderName();
        $slug = Str::slug($alt_text);
        $filename = $slug . "-" . rand(100000, 999999) . "." . $file->getClientOriginalExtension();
        $file->move(public_path('uploaded_images/' . $folder_name), $filename);
        $function = $type->value . "_image";
        $image = $this->$function()->save(PolyImage::create([
            "imageable_type" => static::class,
            "imageable_id" => $this->id,
            "alt" => $alt_text,
            "file_name" => $filename,
            "slug" => $slug,
            "type" => $type->value,
            "order" => $order
        ]));
        return $image;
    }

    private function updateImage($file, $alt_text = "", $optimize, $watermark, ImageType $type)
    {
        $function = $type->value . "_image";
        $image = $this->$function;
        if ($image?->file_name === null) {
            return $this->storeImage($file, $alt_text, $optimize, $watermark, $type);
        }
        if ($alt_text == "") {
            $alt_text = $file->getClientOriginalName();
        }
        $folder_name = $this->getFolderName();
        $slug = Str::slug($alt_text);
        $filename = $slug . "-" . rand(100000, 999999) . "." . $file->getClientOriginalExtension();
        if (isset($image)) {
            @unlink('uploaded_images/' . $folder_name . '/' . $image->file_name);
        }
        $file->move(public_path('uploaded_images/' . $folder_name), $filename);

        $image->update([
            "alt" => $alt_text,
            "file_name" => $filename,
            "slug" => $slug
        ]);
        return $image;
    }


    public function feature_image()
    {
        return $this->morphOne(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_FEATURE])
            ->withDefault([
                'file_name' => null,
                'alt' => "File not found",
            ]);
    }

    public function icon_image()
    {
        return $this->morphOne(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_ICON])
            ->withDefault([
                'file_name' => null,
                'alt' => "File not found",
            ]);
    }

    public function cover_image()
    {
        return $this->morphOne(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_COVER])
            ->withDefault([
                'file_name' => null,
                'alt' => "File not found",
            ]);
    }

    public function meta_image()
    {
        return $this->morphOne(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_META])
            ->withDefault([
                'file_name' => null,
                'alt' => "File not found",
            ]);
    }

    public function gallery_image()
    {
        return $this->morphMany(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_GALLERY]);
    }

    public function doc_image()
    {
        return $this->morphMany(PolyImage::class, 'imageable')->where(["type" => ImageType::TYPE_DOCS]);
    }

    private function getFolderName()
    {
        $parts = explode("\\", static::class);
        return strtolower(array_pop($parts));
    }
}
