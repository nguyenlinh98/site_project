<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use Framework\Components\Request;


class ProductController extends BaseController
{
    protected $product;
    protected $request;

    public function __construct()
    {
        $this->product = new Product();
        $this->request = new Request();
    }

    /**
     * @return array
     * Method get all record and return array record
     *
     **/
    public function listProduct ()
    {

        $recordInPage = 5;  // number record in page
        $total = count($this->product->all());  // total category query from database
        $numberPage = ceil($total / $recordInPage);  // number page
        $start = $this->getNumberHandling() * $recordInPage;  // at the start'th position in database

        //get request current page
        $products = $this->product->GetLimit($start, $recordInPage);

        $page = $this->request->getRequestGet("page") ?? 1;
        $action = $this->request->getRequestGet("action");
        $data = [
            "products" => $products,
            "numberPage" => $numberPage,
            "page" => $page,
            "action" => $action,

        ];
        $this->render('Product/listProduct', 'data', $data);
    }

    /**
     * Method show form create
     */
    public function create()
    {
        $this->render('Product/addProduct');
    }

    /**
     * Method check
     * @param $filename
     * @return bool
     */
    public function isImage($filename)
    {
        $imageType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $arr = ['jpg', 'png', 'jpeg', 'gif'];
        return in_array($imageType, $arr);
    }

    protected function uploadImage($nameFieldImage)
    {
        $result = "";
        if ($_FILES[$nameFieldImage]["name"] != '') {
            $result = time() . $_FILES["$nameFieldImage"]["name"];
            move_uploaded_file($_FILES["$nameFieldImage"]["tmp_name"], "upload/products/$result");
        }
        return $result;
    }

    protected function updateImage($nameFieldImage, $id)
    {
        $result = "";
        if ($_FILES[$nameFieldImage]["name"] != '') {
            // remove old image
            $this->removeImage($nameFieldImage, $id);

            // upload new image
            $result = $this->uploadImage($nameFieldImage);
        }
        return $result;
    }

    protected function removeImage($nameFieldImage, $id)
    {
        // remove old image
        $oldProduct = $this->model->getRecordCondition("id = $id");
        if ($oldProduct->$nameFieldImage != '' && file_exists("upload/products/" . $oldProduct->$nameFieldImage)) {
            unlink("upload/products/" . $oldProduct->$nameFieldImage);
        }
    }


    /***
     *
     * Method create a record and navigate to listProduct
     */

    public function store()
    {

        $request = $this->request->getRequestPost();
        $name = $request['name'];
        $email = $request['price'];
        $description = $request['description'];
        $status = $request['status'];
        $result = $this->product->create($request);
        if ($_FILES["img"]["name"] != '') {
            $filename = time() . $_FILES["img"]["name"];
            move_uploaded_file($_FILES["img"]["tmp_name"], "stroge/$filename");
        }

        $result = $this->product->create($request);
        header("Location:index.php?controllers=Product&&action=listProduct");
    }


    /**
     *
     * Method navigate to editProduct with id =$id
     */
    public function showUpdate()
    {
        $id = $this->request->getRequestGet('id');

        $result = $this->product->find($id)->get();

        $this->render('Product/editProduct', 'result', $result);
    }

    public function update()
    {
        $request = $this->request->getRequestPost();
        $id = $request['id'];
        $result = $this->product->update($request, $id);
        header("Location:index.php?controllers=Product&&action=listProduct");

    }

    public function active()
    {
        $status = 1;
        $listId = $this->request->getRequestPost()['listId'];
        $active = $this->request->getRequestPost()['active'];
        if ($active == 'false') {
            $status = 0;
        }
        foreach ($listId as $value) {
            $this->category->update(['status' => $status], $value);
        }
        $category = $this->category->all();
        $this->render("Category/list-render", 'category', $category);

    }

    /**
     * Method sort order by  each column
     *
     */

    public function sort()
    {
        $typeSort = $this->request->getRequestGet()['typeSort'];
        $sort = $this->request->getRequestGet()['sort'];

        $category = $this->category->getAllOrderBy($typeSort, $sort)->getarr();
        $this->render("Category/list-render", 'category', $category);

    }

    /**
     *
     * Methord search all data with values search =$search_name
     * return list page with  all record comfort with requirement
     */

    public function search()
    {
        $name = $this->request->getRequestPost('search_name');
        $listProduct = $this->product->search($name);
        $this->render('Product/listProduct', 'listProduct', $listProduct);
    }

    /**
     * Method detroy record with id =$id
     */
    public function delete()
    {

        $id = $this->request->getRequestGet('id');
        $result = $this->product->delete($id);
        header("Location:index.php?controllers=Product&&action=listProduct");
    }

    protected function getNumberHandling()
    {
        return isset($_GET["page"]) && $_GET["page"] >= 1 ? ($_GET["page"] - 1) : 0;
    }

}