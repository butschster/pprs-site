<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Arr;

class PagesTableSeeder extends Seeder
{
    protected $states;

    /**
     * @param array $states
     */
    public function run($states = ['banner', 'section_image'])
    {
        $this->states = $states;

        $pages = [
            [
                'title' => 'Что такое рассеяный склероз',
                'children' => [
                    [
                        'title' => 'Типы РС',
                    ],
                    [
                        'title' => 'Причины РС',
                    ],
                    [
                        'title' => 'Симптомы РС',
                    ],
                    [
                        'title' => 'Кто может столкнуться с РС?',
                    ],
                ],
            ],
            [
                'title' => 'Диагностика',
                'children' => [
                    [
                        'title' => 'ППРС',
                        'children' => [
                            [
                                'title' => 'как протекает ППРС?',
                            ],
                            [
                                'title' => 'как ставится диагноз? (что нужно сказать врачу?)',
                            ],
                            [
                                'title' => 'дополнительные методы диагностики',
                            ],
                        ],
                    ],
                    [
                        'title' => 'РС с обострениями',
                        'children' => [
                            [
                                'title' => 'как протекает РС с обострениями?',
                            ],
                            [
                                'title' => 'как ставится диагноз? (что нужно сказать врачу?)',
                            ],
                            [
                                'title' => 'роль МРТ в диагностике РС (Интервью с ВВБ-на будущее)',
                            ],
                            [
                                'title' => 'дополнительные методы диагностики РС',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Лечение',
                'children' => [
                    [
                        'title' => 'Лекарственные препараты',
                    ],
                    [
                        'title' => 'Стероиды и симптоматическая лекарственная терапия.',
                    ],
                    [
                        'title' => 'Анти-В-клеточная терапия.',
                    ],
                ],
            ],
            [
                'title' => 'Реабилитация и физическая активность',
                'children' => [
                    [
                        'title' => 'Упражнения в удовольствие',
                    ],
                ],
            ],
            [
                'title' => 'Уменьшение симптомов',
                'children' => [

                ],
            ],
            [
                'title' => 'Психологическая поддержка',
                'children' => [

                ],
            ],
            [
                'title' => 'Образ жизни',
                'children' => [
                    [
                        'title' => 'Личные истории',
                    ],
                    [
                        'title' => 'Упражнения',
                        'children' => [
                            [
                                'title' => 'правила занятий',
                            ],
                            [
                                'title' => 'типы упражнений',
                            ],
                            [
                                'title' => 'с чего начать тренироваться',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Диета',
                        'children' => [
                            [
                                'title' => 'типы диет',
                            ],
                            [
                                'title' => 'витамины при ППРС',
                            ],
                            [
                                'title' => 'здоровое питание',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Работа  и карьера',
                    ],
                    [
                        'title' => 'Путешествия',
                    ],
                    [
                        'title' => 'Образ жизни',
                        'children' => [
                            [
                                'title' => 'сон',
                            ],
                            [
                                'title' => 'техники расслабления',
                            ],
                            [
                                'title' => 'стресс',
                            ],
                            [
                                'title' => 'как обустроить дом',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Правовая информация',
                'children' => [
                    [
                        'title' => 'Права пациента',
                    ],
                    [
                        'title' => 'Как получить инновационные лекарства, не входящие в федеральные перечни',
                    ],
                    [
                        'title' => 'Инвалидность',
                    ],
                    [
                        'title' => 'Общественные группы и организации (оказывающие поддержку пациентам с РС)',
                    ],
                ],
            ],
        ];

        foreach ($pages as $page) {
            $this->createPage($page);
        }
    }

    /**
     * @param array $data
     * @param Page|null $parent
     */
    protected function createPage(array $data, Page $parent = null)
    {
        $children = Arr::pull($data, 'children');

        $factory = factory(Page::class);

        if (!empty($this->states)) {
            $factory->states($this->states);
        }

        if (empty($children)) {
            $data['banner'] = null;
        }

        $page = $factory->create($data);

        if ($parent) {
            $parent->appendNode($page);
        }

        if (!empty($children)) {
            foreach ($children as $child) {
                $this->createPage($child, $page);
            }
        }
    }
}
