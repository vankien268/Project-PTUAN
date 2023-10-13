<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::truncate();
		$data = [
			[//1
				'name' => 'Tiểu cảnh',
				'slug' => 'tieu-canh',
				'parent_id' => 0,
				'level' => 1
			],
			[//2
				'name' => 'Ấm chén',
				'slug' => 'am-chen',
				'parent_id' => 0,
				'level' => 1
			],
			[//3
				'name' => 'Chậu cảnh',
				'slug' => 'chau-canh',
				'parent_id' => 0,
				'level' => 1
			],
			[//4
				'name' => 'Gốm sứ bát tràng',
				'slug' => 'gom-su-bat-trang',
				'parent_id' => 0,
				'level' => 1
			],
			[//5
				'name' => 'Ấm tử sa đắp nổi',
				'slug' => 'am-tu-sa-dap-noi',
				'parent_id' => 2,
				'level' => 2
			],
			[//6
				'name' => 'Ấm tử sa điêu khắc',
				'slug' => 'am-tu-sa-dieu-khac',
				'parent_id' => 2,
				'level' => 2
			],
			[//7
				'name' => 'Chậu mini',
				'slug' => 'chau-mini',
				'parent_id' => 3,
				'level' => 2
			],
			[//8
				'name' => 'Chậu siêu mini',
				'slug' => 'chau-sieu-mini',
				'parent_id' => 3,
				'level' => 2
			],
			[//9
				'name' => 'Chậu tượng',
				'slug' => 'chau-tuong',
				'parent_id' => 3,
				'level' => 2
			],
			[//10
				'name' => 'Điếu bát men dạn bọc đồng',
				'slug' => 'dieu-bat-men-dan-boc-dong',
				'parent_id' => 4,
				'level' => 2
			],
		];

		Category::insert($data);
	}
}
