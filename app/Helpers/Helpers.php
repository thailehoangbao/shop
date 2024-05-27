<?php
// Vào composer.json thêm dòng sau: "files": ["app/Helpers/Helpers.php"]
namespace App\Helpers;
//composer dump-autoload
class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $menu['id'] . '</td>
                    <td>' . $char . $menu['name'] . '</td>
                    <td>' . $menu['description'] . '</td>
                    <td>' . $menu['content'] . '</td>
                    <td>' . $menu['active'] . '</td>
                    <td>' . $menu['updated_at'] . '</td>
                    <td>
                        <a class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" onclick="removeRow(' . $menu['id'] . ',\'admin/menus/destroy\')" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></a>
                    </td>
                ';

                $html .= self::menu($menus, $menu['id'], $char . '--');
            }
        }
        return $html;
    }

    public static function active($active = 0): string
{
    return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
        : '<span class="btn btn-success btn-xs">YES</span>';
}

}
// \'/admin/menus/destroy\'

