<?php

// BucketController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball;

class BucketController extends Controller
{
     public function create()
    {   
        $buckets = Bucket::latest()->first();
        $ballVolumes = Ball::select("color","size")->get()->toArray();

        $formattedCombinations = [];        
        if(!empty($buckets) && !empty($ballVolumes)){
            $validCombinations = $this->generateValidCombinations($ballVolumes, $buckets->capacity);
            foreach ($validCombinations as $combination) {
                $formattedCombination = [];
                foreach ($combination as $ball) {
                    $formattedCombination[] = $ball['count'] . ' ' . $ball['name'] . ' ball';
                }
                $formattedCombinations[] = implode(', ', $formattedCombination);
            }
        }

        //dd($formattedCombinations);
        return view('buckets.create',compact('buckets','ballVolumes','formattedCombinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|numeric|min:1',
        ]);
        Bucket::truncate();
        $bucket = new Bucket();
        $bucket->name = $request->name;
        $bucket->capacity = $request->capacity;
        $bucket->save();

        return redirect('/buckets/create')->with('success', 'Bucket created successfully!');
    }

    private function generateValidCombinations($ballVolumes, $bucketVolume)
    {
        $validCombinations = [];
        $this->generateCombinations($ballVolumes, 0, [], $bucketVolume, $validCombinations);
        return $validCombinations;
    }

    private function generateCombinations($ballVolumes, $index, $currentCombination, $remainingVolume, &$validCombinations)
    {
        if ($remainingVolume === 0) {
            $validCombinations[] = $currentCombination;
            return;
        }

        if ($index >= count($ballVolumes) || $remainingVolume < 0) {
            return;
        }

        $ball = $ballVolumes[$index];
        $maxCount = (int) ($remainingVolume / $ball['size']);
        for ($count = 0; $count <= $maxCount; $count++) {
            $newCombination = $currentCombination;
            $newCombination[] = ['name' => $ball['color'], 'value' => $ball['size'], 'count' => $count];
            $newRemainingVolume = $remainingVolume - $count * $ball['size'];
            $this->generateCombinations($ballVolumes, $index + 1, $newCombination, $newRemainingVolume, $validCombinations);
        }
    }
}

