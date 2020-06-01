<?php


namespace App\Controllers;

use mysql_xdevapi\Exception;
use App\Controllers\BaseController;
use App\Models\BaseModel;
use App\Models\Categories;
use Framework\Components\Request;


class CategoriesController extends BaseController
{
    protected $category;
    protected $request;
    protected $recordinpage = 4;

    /**
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->category = new Categories();
        $this->request = new Request();
    }

    /**
     * Method get data limit $start and have $record in page
     */
    public function ListCategories ()
    {

        $recordInPage = 5;  // number record in page
        $total = count($this->category->all());  // total category query from database
        $numberPage = ceil($total / $recordInPage);  // number page
        $start = $this->getNumberHandling() * $recordInPage;  // at the start'th position in database

        //get request current page
        $categories = $this->category->GetLimit($start, $recordInPage);

        $page = $this->request->getRequestGet("page") ?? 1;
        $action = $this->request->getRequestGet("action");
        $data = [
            "categories" => $categories,
            "numberPage" => $numberPage,
            "page" => $page,
            "action" => $action,

        ];
        $this->render('Category/ListCategories', 'data', $data);
    }

    /**
     * Method show form create
     */

    public function create()
    {
        $this->render("Category/addCategories");
    }

    /***
     *
     * Method create a record and navigate to listProduct
     */

    public function store()
    {
        $request = $this->request->getRequestPost();
        $name = $request['name'];
        $status = $request['status'];

        $result = $this->category->create($request);
        header("Location:index.php?controllers=Categories&&action=listCategories");

    }

    /**
     *
     * Method navigate to editProduct with id =$id
     */
    public function showUpdate()
    {
        $id = $this->request->getRequestGet('id');

        $result = $this->category->find($id)->get();

        $this->render('Category/editCategories', 'result', $result);
    }

    /**
     *
     * Methord search all data with values search =$search_name
     * return list page with  all record comfort with requirement
     */

    public function update()
    {
        $request = $this->request->getRequestPost();
        $id = $request['id'];

        $result = $this->category->update($request, $id);
        header("Location:index.php?controllers=Categories&&action=listCategories");

    }

    /**
     * Method detroy record with id =$id
     */

    public function delete()
    {
        $id = $this->request->getRequestGet('id');
        $result = $this->category->delete($id);

        header("Location:index.php?controllers=Categories&&action=listCategories");
    }

    /**
     * Method check
     * @param $filename
     * @return bool
     */

    public function deleteByCondition()
    {
        $result = true;
        $listId = $this->request->getRequestPost()['listId'];
        $this->category->destroy('id', $listId);

        echo json_encode($result);

    }

    /**
     *  Method active column checked with arr[id] =$listId
     */

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
     *Method search by name =$search_name
     */

    public function search()
    {
        $name = $this->request->getRequestPost('search_name');
        $list = $this->category->search($name);
        $this->render('Category/ListCategories', 'list', $list);
    }

    protected function getNumberHandling()
    {
        return isset($_GET["page"]) && $_GET["page"] >= 1 ? ($_GET["page"] - 1) : 0;
    }


}