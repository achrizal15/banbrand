<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;


class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // skill develpment array
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
            "XSL-FO",
            "XSL-PFO",
            "XSL-SEC",
            "XSL-TMPL",
            "XSL-XSLT",
            "XSL-XSLT2",
            "XSL-XSLT3",
            "XSL-XSLT4",
            "XSL-XSLT5",
            "XSL-XSLT6",
            "XSL-XSLT7",
            "XSL-XSLT8",
            "XSL-XSLT9",
            "XSL-XSLT10",
            "XSL-XSLT11",
            "XSL-XSLT12",
            "XSL-XSLT13",
            "XSL-XSLT14",
            "XSL-XSLT15",
            "XSL-XSLT16",
            "XSL-XSLT17",
            "XSL-XSLT18",
            "XSL-XSLT19",
            "XSL-XSLT20",
            "XSL-XSLT21",
            "XSL-XSLT22",
            "XSL-XSLT23",
            "XSL-XSLT24",
            "XSL-XSLT25",
            "XSL-XSLT26",
            "XSL-XSLT27",
            "XSL-XSLT28",
            "XSL-XSLT29",];
      
       return[
           "nama"=>$this->faker->unique()->randomElement($skill_development)
       ];
    }
}
