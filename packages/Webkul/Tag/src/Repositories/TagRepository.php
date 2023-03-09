<?php

namespace Webkul\Tag\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Attribute\Repositories\AttributeValueRepository;
use Illuminate\Container\Container;

class TagRepository extends Repository
{
    /**
     * AttributeValueRepository object
     *
     * @var \Webkul\Attribute\Repositories\AttributeValueRepository
     */
    protected $attributeValueRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Webkul\Attribute\Repositories\AttributeValueRepository $attributeValueRepository
     * @param  \Illuminate\Container\Container  $container
     * @return void
     */
    public function __construct(
        AttributeValueRepository $attributeValueRepository,
        Container $container
    )
    {
        $this->attributeValueRepository = $attributeValueRepository;

        parent::__construct($container);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Tag\Contracts\Tag';
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $tag = parent::create($data);
        $this->attributeValueRepository->save($data, $tag->id);

        return $tag;
    }

    /**
     * @param array  $data
     * @param int    $id
     * @param string $attribute
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $tag = parent::update($data, $id);

        $this->attributeValueRepository->save($data, $id);

        return $tag;
    }
}
