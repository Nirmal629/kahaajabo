<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use App\Models\HomeAllSection;
use App\Models\PopularDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class HomePageDynamicController extends Controller
{
    public function index(){
        $get_banner_details = HomeBanner::get();
        $home_dynmaic_data = HomeAllSection::first();
        $destination_data = PopularDestination::get();
        return view('Admin.Home.index', compact('get_banner_details', 'home_dynmaic_data', 'destination_data'));
    }


    public function create(){
        return view('Admin.Home.create');
    }

    public function banner_store(Request $request){
        $request->validate([
            'banner_title'       => 'required|string',
            'banner_sub_title'   => 'nullable|string',
            'banner_description' => 'nullable|string',
            'banner_image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = new HomeBanner();

        $banner->banner_title = $request->banner_title;
        $banner->banner_sub_title = $request->banner_sub_title;
        $banner->banner_description = $request->banner_description;

        // Upload image
        if ($request->hasFile('banner_image')) {

            $file = $request->file('banner_image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $path = public_path('uploads/home-dynamic');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $fileName);

            $banner->banner_image = $fileName;
        }

        $banner->save();

        return redirect()
            ->route('admin.home.dynamic')
            ->with('success', 'Banner added successfully.');
    }

    public function banner_edit($id){

        $banner_data = HomeBanner::where('id', $id)->first();
        return view('Admin.Home.create', compact('banner_data'));
    }


    public function banner_update(Request $request, string $id)
    {
        $request->validate([
            'banner_title'       => 'required|string',
            'banner_sub_title'   => 'nullable|string',
            'banner_description' => 'nullable|string',
            'banner_image'       => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = HomeBanner::findOrFail($id);

        $banner->banner_title = $request->banner_title;
        $banner->banner_sub_title = $request->banner_sub_title;
        $banner->banner_description = $request->banner_description;

        // Upload new image
        if ($request->hasFile('banner_image')) {

            $path = public_path('uploads/home-dynamic');

            // Delete old image
            if (
                $banner->banner_image &&
                file_exists($path . '/' . $banner->banner_image)
            ) {
                unlink($path . '/' . $banner->banner_image);
            }

            $file = $request->file('banner_image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $fileName);

            $banner->banner_image = $fileName;
        }

        $banner->save();

        return redirect()
            ->route('admin.home.dynamic')
            ->with('success', 'Banner updated successfully.');
    }

    public function banner_delete($id){

        $data = HomeBanner::find($id);
        $data->delete();

        return redirect()->route('admin.home.dynamic')->with('error', 'Banner Details deleted successfully.');
    }

    public function banner_update_status(Request $request){
        
        $banner_data = HomeBanner::find($request->id);
    
        if ($banner_data) {
            $banner_data->status = $request->status;
            $banner_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Banner status updated successfully.',
                'status' => $banner_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Banner data not found.'
        ], 404);
    }

    public function second_section_update(Request $request){
        $request->validate([
            'sectionSecond_title' => 'required|string|max:255',
            'sectionSection_description' => 'required|string',
            'third_section_title' => 'required|string|max:255',
        ]);

        $home_dynamic = HomeAllSection::first();

        if (!$home_dynamic) {
            $home_dynamic = new HomeAllSection();
        }

        $home_dynamic->sectionSecond_title = $request->sectionSecond_title;
        $home_dynamic->sectionSection_description = $request->sectionSection_description;
        $home_dynamic->third_section_title = $request->third_section_title;

        $home_dynamic->save();

        return redirect()
            ->back()
            ->with('success', 'Home Second & Third Section details updated successfully.');
    }

    public function fourth_section_update(Request $request){
        $request->validate([
            'fourth_section_heading' => 'required|string|max:255',

            'fourth_section_title_1' => 'required|string|max:255',
            'fourth_section_description_1' => 'required|string',
            'fourth_section_image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'fourth_section_title_2' => 'required|string|max:255',
            'fourth_section_description_2' => 'required|string',
            'fourth_section_image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'fourth_section_title_3' => 'required|string|max:255',
            'fourth_section_description_3' => 'required|string',
            'fourth_section_image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'fourth_section_title_4' => 'required|string|max:255',
            'fourth_section_description_4' => 'required|string',
            'fourth_section_image_4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Get existing record
        $home_dynamic = HomeAllSection::first();

        // If record doesn't exist, create new one
        if (!$home_dynamic) {
            $home_dynamic = new HomeAllSection();
        }

        // Upload directory
        $uploadPath = public_path('uploads/home-dynamic/');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }


        $home_dynamic->fourth_section_heading = $request->fourth_section_heading;

        $home_dynamic->fourth_section_title_1 =
            $request->fourth_section_title_1;

        $home_dynamic->fourth_section_description_1 =
            $request->fourth_section_description_1;

        if ($request->hasFile('fourth_section_image_1')) {
            // Delete old image
            if (
                $home_dynamic->fourth_section_image_1 &&
                File::exists(
                    $uploadPath . $home_dynamic->fourth_section_image_1
                )
            ) {
                File::delete(
                    $uploadPath . $home_dynamic->fourth_section_image_1
                );
            }

            $image = $request->file('fourth_section_image_1');
            $imageName = time() . '_1_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);
            $home_dynamic->fourth_section_image_1 = $imageName;
        }

        $home_dynamic->fourth_section_title_2 =
            $request->fourth_section_title_2;
        $home_dynamic->fourth_section_description_2 =
            $request->fourth_section_description_2;

        if ($request->hasFile('fourth_section_image_2')) {

            // Delete old image
            if (
                $home_dynamic->fourth_section_image_2 &&
                File::exists(
                    $uploadPath . $home_dynamic->fourth_section_image_2
                )
            ) {
                File::delete(
                    $uploadPath . $home_dynamic->fourth_section_image_2
                );
            }

            $image = $request->file('fourth_section_image_2');
            $imageName = time() . '_2_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);
            $home_dynamic->fourth_section_image_2 = $imageName;
        }

        $home_dynamic->fourth_section_title_3 =
            $request->fourth_section_title_3;
        $home_dynamic->fourth_section_description_3 =
            $request->fourth_section_description_3;

        if ($request->hasFile('fourth_section_image_3')) {
            // Delete old image
            if (
                $home_dynamic->fourth_section_image_3 &&
                File::exists(
                    $uploadPath . $home_dynamic->fourth_section_image_3
                )
            ) {
                File::delete(
                    $uploadPath . $home_dynamic->fourth_section_image_3
                );
            }

            $image = $request->file('fourth_section_image_3');
            $imageName = time() . '_3_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);
            $home_dynamic->fourth_section_image_3 = $imageName;
        }

        $home_dynamic->fourth_section_title_4 =
            $request->fourth_section_title_4;
        $home_dynamic->fourth_section_description_4 =
            $request->fourth_section_description_4;

        if ($request->hasFile('fourth_section_image_4')) {
            // Delete old image
            if (
                $home_dynamic->fourth_section_image_4 &&
                File::exists(
                    $uploadPath . $home_dynamic->fourth_section_image_4
                )
            ) {
                File::delete(
                    $uploadPath . $home_dynamic->fourth_section_image_4
                );
            }

            $image = $request->file('fourth_section_image_4');
            $imageName = time() . '_4_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);
            $home_dynamic->fourth_section_image_4 = $imageName;
        }

        $home_dynamic->save();

        return redirect()
            ->back()
            ->with('success', 'Fourth section details updated successfully.');
    }


    public function destination_create(){
        return view('Admin.Home.popularDestination');
    }

    public function destination_store(Request $request){
        $request->validate([
            'destination_name'   => 'required|string',
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $destination = new PopularDestination();
        $destination->destination_name = $request->destination_name;

        // Upload image
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/home-dynamic');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $fileName);
            $destination->image = $fileName;
        }
        $destination->save();

        return redirect()
            ->route('admin.home.dynamic')
            ->with('success', 'Destination added successfully.');
    }

    public function destination_edit($id){

        $destination_data = PopularDestination::where('id', $id)->first();
        return view('Admin.Home.popularDestination', compact('destination_data'));
    }


    public function destination_update(Request $request, string $id)
    {
        $request->validate([
            'destination_name'       => 'required|string',
            'image'       => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $destination = PopularDestination::findOrFail($id);
        $destination->destination_name = $request->destination_name;

        // Upload new image
        if ($request->hasFile('image')) {
            $path = public_path('uploads/home-dynamic');
            // Delete old image
            if (
                $destination->image &&
                file_exists($path . '/' . $destination->image)
            ) {
                unlink($path . '/' . $destination->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $fileName);

            $destination->image = $fileName;
        }

        $destination->save();

        return redirect()
            ->route('admin.home.dynamic')
            ->with('success', 'Destination updated successfully.');
    }

    public function destination_delete($id){

        $data = PopularDestination::find($id);
        $data->delete();

        return redirect()->route('admin.home.dynamic')->with('error', 'Popular Destination Details deleted successfully.');
    }

    public function destination_update_status(Request $request){
        
        $banner_data = PopularDestination::find($request->id);
    
        if ($banner_data) {
            $banner_data->status = $request->status;
            $banner_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Destination status updated successfully.',
                'status' => $banner_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Destination data not found.'
        ], 404);
    }
}
