<template>
    <div class="container">
        <h1>Chart Demo</h1>
        <div class="row">
            <div class="col-md-4">
                <chartjs-doughnut
                :bind="true"
                :datasets="datasets"
                :labels="labels"
                :option="option"
                />                
            </div>
            
            <div class="col-md-4">
                <div class="card-img-bottom">
                    <canvas id="fooCanvas" count="3" />

                    <chartjs-bar
                        v-for="(item, index) in types"
                        :key="index"
                        :backgroundcolor="item.bgColor"
                        :beginzero="beginZero"
                        :bind="true"
                        :bordercolor="item.borderColor"
                        :data="item.data"
                        :datalabel="item.dataLabel"
                        :labels="labelsb"
                        target="fooCanvas"
                    />
                </div>
               
            </div>
            <div class="col-md-4">
                <chartjs-pie
                :bind="true"
                :datasets="datasets"
                :labels="labels"
                :option="option"
                />
            </div>
        </div>

       
    </div>
    
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        computed:{
            category: function() {
            return this.types;
            },

        },
        data() {
            return {   
            datasets: [
                {
                data: [30,30,25,36],
                backgroundColor: ["#f36e60", "#ffdb3b", "#185190","#1ff195"],
                hoverBackgroundColor: ["#fbd2cd", "#fef5c9", "#d1e3f7","#1ff135"]
                }
            ],
            labels: ["Foo", "Bar", "Baz","dog"],
            option: {},
            beginZero: true,
            labelsb: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            types: [
                {
                bgColor: "#de98ab",
                borderColor: "0c0306",
                data: [1, 3, 5, 7, 2, 4, 6],
                dataLabel: "Bar"
                },
                {
                bgColor: "#98ddde",
                borderColor: "030c0c",
                data: [1, 5, 2, 6, 3, 7, 4],
                dataLabel: "Baz"
                },
                {
                bgColor: "#486fdf",
                borderColor: "030c0c",
                data: [1, 4, 6, 4, 7, 5, 4],
                dataLabel: "Bafoo"
                }
            ]
            };
        },
        created(){
            console.log("Test created");
        }
    }
</script>

<style lang="scss" scoped>

</style>