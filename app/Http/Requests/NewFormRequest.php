<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute不能为空',
            'string' => '请检查:attribute格式',
            'unique' => ':attribute已存在',
            'between' => ':attribute需要在:min-:max之间',
            'email' => '请检查:attribute格式',
            'numeric' => '请检查:attribute格式',
            'integer' => ':attribute必须是整数',
        ];
    }

    public function attributes()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'name' => '名称',
            'email' => '邮箱',
            'tel' => '手机号',
            'description' => '描述',
            'parent_id' => '父级',
            'icon' => '图标',
            'category_id' => '关联分类',
            'note_id' => '关联笔记',
            'article_id' => '关联文章',
            'user_id' => '关联用户',
            'series' => '系列号',
            'title' => '标题',
            'introduction' => '引文',
            'route' => '路由',
            'href' => '链接',
            'qq' => 'QQ',
            'sex' => '性别',
            'pic_href' => '头像',
        ];
    }
}
