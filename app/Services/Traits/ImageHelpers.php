<?php

namespace App\Services\Traits;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 2/6/17
 * Time: 8:21 AM
 */

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Exception;

trait ImageHelpers
{


    /**
     * @param Model $model
     * @param Request $request
     * @param array $inputNames
     * @param array $sizes
     * @param array $dimensions
     * @param boolean $ratio
     * @return null
     */
    public function saveMimes(Model $model,
                              Request $request,
                              $inputNames = ['pdf'],
                              $dimensions = ['1052', '1320'],
                              $ratio = true,
                              $sizes = ['large', 'medium', 'thumbnail'])
    {
        try {
            foreach ($inputNames as $key => $inputName) {
                if ($request->hasFile($inputName)) {
                    if (in_array($request->file($inputName)->extension(), ['pdf', 'ppt'], true)) {
                        $path = $request->$inputName->store('public/uploads/files');
                        $path = str_replace('public/uploads/files/', '', $path);
                        $model->update([
                            $inputName => $path,
                        ]);
                    } else {
                        if (env('FILESYSTEM_CLOUD') === 'do') {
                            try {
                                $path = $request->$inputName->storePublicly('public/uploads/images', 'do');
                                $imagePath = str_replace('public/uploads/images/', '', $path);
//                                foreach ($sizes as $k => $value) {
//                                    $fullPath = 'public/uploads/images/' . $value . '/' . $imagePath;
//                                    $contents = Storage::disk('local')->get($fullPath);
//                                    Storage::disk('do')->put($fullPath, $contents, 'public');
//                                }
                                foreach ($sizes as $k => $value) {
                                    Storage::disk('do')->copy($path, 'public/uploads/images/' . $value . '/' . $imagePath);
                                }
                                $model->update([
                                    $inputName => $imagePath,
                                ]);
                            } catch (Exception $e) {
                                return $e->getMessage();
                            }
                        } else {
                            if (in_array($request->file($inputName)->extension(), ['gif'], true)) {
                                $request->$inputName->store('public/uploads/images/thumbnail');
                                $request->$inputName->store('public/uploads/images/medium');
                                $path = $request->$inputName->store('public/uploads/images/large');
                                $path = str_replace('public/uploads/images/large/', '', $path);
                                $model->update([
                                    $inputName => $path,
                                ]);
                            } else {
                                $imagePath = $request->$inputName->store('public/uploads/images');
                                $imagePath = str_replace('public/uploads/images/', '', $imagePath);
                                $img = Image::make(storage_path('app/public/uploads/images/' . $imagePath));
                                foreach ($sizes as $key => $value) {
                                    if ($value === 'large') {
                                        if ($ratio) {
                                            $img->resize($dimensions[0], null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        } else {
                                            $img->resize($dimensions[0], $dimensions[1]);
                                        }
                                        $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath), env('IMAGE_QUALITY'));
                                    } elseif ($value === 'medium') {
                                        if ($ratio) {
                                            $img->resize($dimensions[0] / 2, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        } else {
                                            $img->resize($dimensions[0] / 2, $dimensions[0] / 2);
                                        }
                                        $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                                    } elseif ($value === 'thumbnail') {
                                        if ($ratio) {
                                            $img->resize($dimensions[0] / 3, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        } else {
                                            $img->resize($dimensions[0] / 3, $dimensions[0] / 3);
                                        }
                                        $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                                    }
                                }
                                $model->update([
                                    $inputName => $imagePath,
                                ]);
                                Storage::delete('public/uploads/images/' . $imagePath);
                            }
                        }
                    }
                } else {
                    // in case there is no file
                    return response()->json(['message' => 'else case for image'], 400);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param Request $request
     * @param array $inputNames
     * @param string $width
     * @param string $height
     */
    public function saveImage(Request $request,
                              $inputNames = 'image',
                              $dimensions = ['1200', '560'],
                              $sizes = ['large', 'medium', 'thumbnail'])
    {
        try {
            foreach ($inputNames as $inputName) {
                if ($request->hasFile($inputName)) {
                    if (in_array($request->file($inputName)->extension(), ['pdf', 'ppt'], true)) {
                        $pdfPath = $request->$inputName->store('public/uploads/files');
                        $pdfPath = str_replace('public/', '', $pdfPath);
                        return $pdfPath;
                    } else {
                        $imagePath = $request->$inputName->store('public/uploads/images');
                        $imagePath = str_replace('public/uploads/images/', '', $imagePath);
                        $img = Image::make(storage_path('app/public/uploads/images/' . $imagePath));
                        foreach ($sizes as $key => $value) {
                            switch ($value) {
                                case $value === 'large' :
                                    $this->saveIt($img, $dimensions[0], $value, $imagePath);
                                    break;
                                case $value === 'medium' :
                                    $this->saveIt($img, $dimensions[0] / 2, $value, $imagePath);
                                    break;
                                case $value === 'thumbnail' :
                                    $this->saveIt($img, $dimensions[0] / 3, $value, $imagePath);
                                    break;
                                default :
                                    $this->saveIt($img, $dimensions[0] / 2, $value, $imagePath);
                            }
                        }
                        Storage::delete('public/uploads/images/' . $imagePath);
                        return $imagePath;
                    }
                } else {
                    // in case there is no file
                    return null;
                }
            }
        } catch
        (\Exception $e) {
            abort(404, 'save Image Error : ' . $e->getMessage());
        }
    }


    /**
     * @param Model $model
     * @param Request $request
     * @param string $inputName
     * @param array $dimensions
     * @param bool $ratio
     * @param array $sizes
     */
    public function saveGallery(Model $model,
                                Request $request,
                                $inputName = 'images',
                                $dimensions = ['1052', '1320'],
                                $ratio = true,
                                $sizes = ['large', 'medium', 'thumbnail'])
    {
        try {
            if ($request->hasFile($inputName)) {
                if (count($request[$inputName]) > 1) {
                    foreach ($request[$inputName] as $image) {
                        if (env('FILESYSTEM_CLOUD') === 'do') {
                            try {
                                $path = $image->storePublicly('public/uploads/images', 'do');
                                $imagePath = str_replace('public/uploads/images/', '', $path);
                                foreach ($sizes as $k => $value) {
//                                    $image->storePublicly('public/uploads/images/' . $value . '', 'do');
                                    Storage::disk('do')->copy($path, 'public/uploads/images/' . $value . '/' . $imagePath);
                                }
                            } catch (Exception $e) {
                                return $e->getMessage();
                            }
                        } else {
                            $imagePath = $this->saveImageForGallery($image, $dimensions, $ratio, $sizes, $model);
                        }
                        $model->images()->create([
                            'image' => $imagePath,
                        ]);
                    }
                } else {
                    if (env('FILESYSTEM_CLOUD') === 'do') {
                        try {
                            $path = $request[$inputName][0]->storePublicly('public/uploads/images', 'do');
                            $imagePath = str_replace('public/uploads/images/', '', $path);
                            foreach ($sizes as $k => $value) {
//                                $request[$inputName][0]->storePublicly('public/uploads/images/' . $value . '', 'do');
                                Storage::disk('do')->copy($path, 'public/uploads/images/' . $value . '/' . $imagePath);
                            }
                        } catch (Exception $e) {
                            return $e->getMessage();
                        }
                    } else {
                        $imagePath = $this->saveImageForGallery($request[$inputName][0], $dimensions, $ratio, $sizes, $model);
                    }
                    return $model->images()->create([
                        'image' => $imagePath,
                    ]);
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            abort(404, 'save Error : ' . $e->getMessage());
        }
    }

    public function saveIt($img, $width, $sizeType, $imagePath)
    {
        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path('app/public/uploads/images/' . $sizeType . '/' . $imagePath));
        if (env('FILESYSTEM_CLOUD') === 'do') {
            try {
                $fullPath = 'public/uploads/images/' . $sizeType . '/' . $imagePath;
                $contents = Storage::disk('local')->get($fullPath);
                Storage::disk('do')->put($fullPath, $contents, 'public');
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function saveImageForGallery($image, $dimensions, $ratio, $sizes, $model)
    {
        $imagePath = $image->store('public/uploads/images');
        $imagePath = str_replace('public/uploads/images/', '', $imagePath);
        $img = Image::make(public_path('storage/uploads/images/' . $imagePath));
        foreach ($sizes as $key => $value) {
            if ($value === 'large') {
                if ($ratio) {
                    $img->resize($dimensions[0], null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize($dimensions[0], $dimensions[1]);
                }
                $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath), env('IMAGE_QUALITY'));
            } elseif ($value === 'medium') {
                if ($ratio) {
                    $img->resize($dimensions[0] / 2, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize($dimensions[0] / 2, $dimensions[0] / 2);
                }
                $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath), env('IMAGE_QUALITY'));
            } elseif ($value === 'thumbnail') {
                if ($ratio) {
                    $img->resize($dimensions[0] / 3, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize($dimensions[0] / 3, $dimensions[0] / 3);
                }
//                $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath), env('IMAGE_QUALITY'));
            }
        }
        Storage::delete(public_path('storage/uploads/images/' . $imagePath));
        return $imagePath;
    }


    /**
     * @param Model $model
     * @param Request $request
     * @param array $inputNames
     * @param array $sizes
     * @param array $dimensions
     * @param boolean $ratio
     * @return null
     */
    public function saveMimesGroup(Model $model,
                                   Request $request,
                                   $inputNames = 'images',
                                   $dimensions = ['1052', '1320'],
                                   $ratio = true,
                                   $sizes = ['large', 'medium', 'thumbnail'])
    {
        try {
            if ($request->has($inputNames)) {
                foreach ($request->$inputNames as $k => $v) {
                    $imagePath = $request->$inputNames[$k]->store('public/uploads/images');
                    $imagePath = str_replace('public/uploads/images/', '', $imagePath);
                    $img = Image::make(storage_path('app/public/uploads/images/' . $imagePath));
                    foreach ($sizes as $key => $value) {
                        if ($value === 'large') {
                            if ($ratio) {
                                $img->resize($dimensions[0], null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $img->resize($dimensions[0], $dimensions[1]);
                            }
                            $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                        } elseif ($value === 'medium') {
                            if ($ratio) {
                                $img->resize($dimensions[0], null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $img->resize($dimensions[0] / 2, $dimensions[0] / 2);
                            }
                            $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                        }
                        if ($value === 'thumbnail') {
                            if ($ratio) {
                                $img->resize('300', null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $img->resize($dimensions[0] / 3, $dimensions[0] / 3);
                            }
                            $img->save(storage_path('app/public/uploads/images/' . $value . '/' . $imagePath));
                        }
                    }
                    $newImage = \App\Models\Image::create(['user_id' => $model->id, 'name' => $imagePath]);
                    $newImage ? Storage::delete('public/uploads/images/' . $imagePath) : null;
                }
            } else {
                return new \Excption('no values [] !!');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function savePath(Request $request, $element)
    {
        try {
            if ($request->hasFile('video_one')) {
                $path = $request->file('video_one')->store('public/uploads/files');
                $path = str_replace('public/uploads/files/', '', $path);
                if (env('FILESYSTEM_CLOUD') === 'do') {
                    try {
                        $fullPath = 'public/uploads/files/' . $path;
                        $contents = Storage::disk('local')->get($fullPath);
                        Storage::disk('do')->put($fullPath, $contents, 'public');
                    } catch (Exception $e) {
                        return $e->getMessage();
                    }
                }
                $element->update(['path' => $path]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
