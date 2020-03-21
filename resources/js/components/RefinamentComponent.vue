<template>
    <div class="col-md-2 d-block">
        <ais-panel>
            <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
            <template slot="default">
                <ais-refinement-list
                    attribute="DepName"
                    :searchable="false"
                    searchablePlaceholder="Search for brands…"
                >
                </ais-refinement-list>
            </template>
        </ais-panel>

        <ais-panel>
            <h6 class="font-weight-bold mt-3">TIPO DE PRENDA</h6>
            <template slot="default">
                <ais-refinement-list
                    attribute="ClothingTypeName"
                    :searchable="false"
                    searchablePlaceholder="Search for brands…"
                />
            </template>
        </ais-panel>

        <ais-panel>
            <h6 class="font-weight-bold mt-3">MARCA</h6>
            <template slot="default">
                <ais-refinement-list
                    attribute="BrandName"
                    :searchable="false" 
                    searchablePlaceholder="Search for brands…"
                />
            </template>
        </ais-panel>

        <ais-panel>
            <h6 class="font-weight-bold mt-3">COLOR</h6>
            <template slot="default">
                <ais-refinement-list
                    attribute="ColorName"
                    :searchable="false"
                    searchablePlaceholder="Search for brands…"
                />
            </template>
        </ais-panel>    
    </div>                
</template>

<script>
