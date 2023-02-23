<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseFirestore
{
    protected $db;

    public function __construct()
    {
        $this->db = new FirestoreClient([
            'projectId' => config('services.firebase.project_id'),
        ]);
    }
}
