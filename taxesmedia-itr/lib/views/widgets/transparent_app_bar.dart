import 'package:flutter/material.dart';

class TransparentAppBar extends StatelessWidget implements PreferredSizeWidget {
  const TransparentAppBar({
    Key? key,
    this.title,
    this.showDefaultLeading = true,
  }) : super(key: key);

  final String? title;
  final bool showDefaultLeading;

  @override
  Size get preferredSize => const Size.fromHeight(60);

  @override
  Widget build(BuildContext context) {
    return AppBar(
      backgroundColor: Colors.transparent,
      elevation: 0,
      foregroundColor: Colors.black,
      automaticallyImplyLeading: showDefaultLeading,
      centerTitle: true,
      title: title != null
          ? Text(
              title!,
              style: Theme.of(context).textTheme.titleLarge?.copyWith(
                    fontSize: 20,
                  ),
            )
          : null,
    );
  }
}
