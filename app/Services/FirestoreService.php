<?php

namespace App\Services;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;

class Firestore {
    public function client(): FirestoreClient {
        return new FirestoreClient([
            'projectId' => config('services.firestore.project_id'),
        ]);
    }
}
