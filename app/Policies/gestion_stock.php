<?php

namespace App\Policies;

use App\Models\User;

use Sentinel;

use Illuminate\Auth\Access\HandlesAuthorization;

class gestion_stock
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function view_product(User $user)
             {

                $user = Sentinel::findById(1);
            
               $auth   = $user->hasAccess('product.read'); 
               $t= true;

               return true;
       
           }

}
