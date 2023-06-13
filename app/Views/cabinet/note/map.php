<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vis Network | Basic usage</title>

    <script type="text/javascript" src="/js/vis.js"></script>

    <style type="text/css">
        #mynetwork {
            width: 600px;
            height: 400px;
            border: 1px solid lightgray;
        }
    </style>
</head>

<body>
    <?/*<p>Create a simple network with some nodes and edges.</p>
    <? foreach ($map as $key => $row) { ?>
        { id: <?= $row['id']; ?>, label:"<?= $row['title'] ?>"},
        <? foreach ($row['desc'] as $key => $row) { ?>
            { id: <?= $row['id']; ?>, label:"<?= $row['title'] ?>"},
            <? foreach ($row['desc'] as $key => $row) { ?>
                { id: <?= $row['id']; ?>, label:"<?= $row['title'] ?>"},
            <? } ?>
        <? } ?>
    <? } ?>

    <? foreach ($map as $key => $row) { ?>
        <? foreach ($row['desc'] as $key => $row1) { ?>
            {from: <?= $row['id']; ?>, to:<?= $row1['id'] ?>},
            <? foreach ($row1['desc'] as $key => $row2) { ?>
                {from: <?= $row1['id']; ?>, to:<?= $row2['id'] ?>},
            <? } ?>
        <? } ?>
    <? } ?>*/?>

    <div id="mynetwork"></div>

    <script type="text/javascript">
        // create an array with nodes

        var nodes = new vis.DataSet([
            <? foreach ($map as $key => $row) { ?> {
                    id: <?= $row['id']; ?>,
                    label: "<?= $row['title'] ?>"
                },
                <? foreach ($row['desc'] as $key => $row) { ?> {
                        id: <?= $row['id']; ?>,
                        label: "<?= $row['title'] ?>"
                    },
                    <? foreach ($row['desc'] as $key => $row) { ?> {
                            id: <?= $row['id']; ?>,
                            label: "<?= $row['title'] ?>"
                        },
                    <? } ?>
                <? } ?>
            <? } ?>
        ]);

        // create an array with edges
        var edges = new vis.DataSet([
            <? foreach ($map as $key => $row) { ?>
                <? foreach ($row['desc'] as $key => $row1) { ?> { from: <?= $row['id']; ?>, to: <?= $row1['id'] ?> },
                    <? foreach ($row1['desc'] as $key => $row2) { ?> { from: <?= $row1['id']; ?>, to: <?= $row2['id'] ?> },
                    <? } ?>
                <? } ?>
            <? } ?>
        ]);

        // create a network
        var container = document.getElementById("mynetwork");
        var data = {
            nodes: nodes,
            edges: edges,
        };
        var options = {};
        var network = new vis.Network(container, data, options);
    </script>
</body>

</html>