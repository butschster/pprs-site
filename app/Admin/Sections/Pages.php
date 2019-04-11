<?php

namespace App\Admin\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Admin\Form\Elements\Collapsed;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Pages
 *
 * @property \App\Model\Page $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Pages extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Pages';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setIcon('fa fa-sitemap');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::tree()->setValue('title');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()
            ->addHeader([
                AdminFormElement::text('title', 'Название')
                    ->required()
                    ->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::text('slug', 'Текст в ссылке')
                    ->addValidationRule('nullable')
                    ->addValidationRule('alpha_dash'),
            ])
            ->addElement(new Collapsed('Мета дата', [
                AdminFormElement::text('meta_title', 'Meta title'),
                AdminFormElement::text('meta_keywords', 'Meta keywords'),
                AdminFormElement::text('meta_description', 'Meta description'),
            ]))->addBody([
                AdminFormElement::wysiwyg('text', 'Текст', 'ckeditor'),
            ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
}