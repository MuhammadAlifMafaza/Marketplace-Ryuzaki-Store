<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SubCategoriesModel;
use App\Models\MasterCategoriesModel;
use App\Models\ProductSubCategoriesModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{

    protected $productModel;
    protected $subCategoriesModel;
    protected $masterCategoriesModel;
    protected $productSubCategoriesModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->subCategoriesModel = new SubCategoriesModel();
        $this->masterCategoriesModel = new MasterCategoriesModel();
        $this->productSubCategoriesModel = new ProductSubCategoriesModel();
    }

    public function dashboard()
    {
        // menampilkan halaman dashboard admin
        return view('employers\admin\index.php');
    }

    /* function untuk kelola data produk (CRUD) */
    

    /* Function untuk kelola category product (CRUD) */

    /* Function untuk kelola data order */

    /* Function untuk kelola data karyawan */

    /* Function untuk kelola data users */
}
