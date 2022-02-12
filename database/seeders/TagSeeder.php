<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_development = [
            "PHP",
            "Laravel",
            "JavaScript",
            "Vue.js",
            "React.js",
            "Node.js",
            "MySQL",
            "MongoDB",
            "HTML",
            "CSS",
            "Sass",
            "Bootstrap",
            "jQuery",
            "AJAX",
            "JSON",
            "XML",
            "XSLT",
            "XPath",
            "XQuery",
            "XSL",
            "XSD",
            "XSLT",
            "XSL-XSLT29",
        ];
        //loop factory skill develpment
        foreach ($skill_development as $skill) {
            Tag::create([
                "nama" => $skill,
            ]);
        }
    }
}
